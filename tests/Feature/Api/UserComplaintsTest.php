<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Complaint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserComplaintsTest extends TestCase
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
    public function it_gets_user_complaints()
    {
        $user = User::factory()->create();
        $complaints = Complaint::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.complaints.index', $user));

        $response->assertOk()->assertSee($complaints[0]->content);
    }

    /**
     * @test
     */
    public function it_stores_the_user_complaints()
    {
        $user = User::factory()->create();
        $data = Complaint::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.complaints.store', $user),
            $data
        );

        $this->assertDatabaseHas('complaints', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $complaint = Complaint::latest('id')->first();

        $this->assertEquals($user->id, $complaint->user_id);
    }
}
