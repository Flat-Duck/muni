<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Complaint;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityComplaintsTest extends TestCase
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
    public function it_gets_municipality_complaints()
    {
        $municipality = Municipality::factory()->create();
        $complaints = Complaint::factory()
            ->count(2)
            ->create([
                'municipality_id' => $municipality->id,
            ]);

        $response = $this->getJson(
            route('api.municipalities.complaints.index', $municipality)
        );

        $response->assertOk()->assertSee($complaints[0]->content);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality_complaints()
    {
        $municipality = Municipality::factory()->create();
        $data = Complaint::factory()
            ->make([
                'municipality_id' => $municipality->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.municipalities.complaints.store', $municipality),
            $data
        );

        $this->assertDatabaseHas('complaints', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $complaint = Complaint::latest('id')->first();

        $this->assertEquals($municipality->id, $complaint->municipality_id);
    }
}
