<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ComplaintType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplaintTypeTest extends TestCase
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
    public function it_gets_complaint_types_list()
    {
        $complaintTypes = ComplaintType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.complaint-types.index'));

        $response->assertOk()->assertSee($complaintTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_complaint_type()
    {
        $data = ComplaintType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.complaint-types.store'), $data);

        $this->assertDatabaseHas('complaint_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_complaint_type()
    {
        $complaintType = ComplaintType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.complaint-types.update', $complaintType),
            $data
        );

        $data['id'] = $complaintType->id;

        $this->assertDatabaseHas('complaint_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_complaint_type()
    {
        $complaintType = ComplaintType::factory()->create();

        $response = $this->deleteJson(
            route('api.complaint-types.destroy', $complaintType)
        );

        $this->assertModelMissing($complaintType);

        $response->assertNoContent();
    }
}
