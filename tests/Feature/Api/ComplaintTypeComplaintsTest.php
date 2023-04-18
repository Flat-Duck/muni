<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Complaint;
use App\Models\ComplaintType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplaintTypeComplaintsTest extends TestCase
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
    public function it_gets_complaint_type_complaints()
    {
        $complaintType = ComplaintType::factory()->create();
        $complaints = Complaint::factory()
            ->count(2)
            ->create([
                'complaint_type_id' => $complaintType->id,
            ]);

        $response = $this->getJson(
            route('api.complaint-types.complaints.index', $complaintType)
        );

        $response->assertOk()->assertSee($complaints[0]->content);
    }

    /**
     * @test
     */
    public function it_stores_the_complaint_type_complaints()
    {
        $complaintType = ComplaintType::factory()->create();
        $data = Complaint::factory()
            ->make([
                'complaint_type_id' => $complaintType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.complaint-types.complaints.store', $complaintType),
            $data
        );

        unset($data['complaint_type_id']);

        $this->assertDatabaseHas('complaints', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $complaint = Complaint::latest('id')->first();

        $this->assertEquals($complaintType->id, $complaint->complaint_type_id);
    }
}
