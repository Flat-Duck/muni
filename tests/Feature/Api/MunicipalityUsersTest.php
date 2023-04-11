<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityUsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_municipality_users()
    {
        $municipality = Municipality::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'municipality_id' => $municipality->id,
            ]);

        $response = $this->getJson(
            route('api.municipalities.users.index', $municipality)
        );

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality_users()
    {
        $municipality = Municipality::factory()->create();
        $data = User::factory()
            ->make([
                'municipality_id' => $municipality->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.municipalities.users.store', $municipality),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($municipality->id, $user->municipality_id);
    }
}
