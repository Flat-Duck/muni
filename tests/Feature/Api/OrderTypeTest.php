<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\OrderType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTypeTest extends TestCase
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
    public function it_gets_order_types_list()
    {
        $orderTypes = OrderType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.order-types.index'));

        $response->assertOk()->assertSee($orderTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_type()
    {
        $data = OrderType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.order-types.store'), $data);

        $this->assertDatabaseHas('order_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_order_type()
    {
        $orderType = OrderType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.order-types.update', $orderType),
            $data
        );

        $data['id'] = $orderType->id;

        $this->assertDatabaseHas('order_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_order_type()
    {
        $orderType = OrderType::factory()->create();

        $response = $this->deleteJson(
            route('api.order-types.destroy', $orderType)
        );

        $this->assertModelMissing($orderType);

        $response->assertNoContent();
    }
}
