<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTypeOrdersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_order_type_orders()
    {
        $orderType = OrderType::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'order_type_id' => $orderType->id,
            ]);

        $response = $this->getJson(
            route('api.order-types.orders.index', $orderType)
        );

        $response->assertOk()->assertSee($orders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_type_orders()
    {
        $orderType = OrderType::factory()->create();
        $data = Order::factory()
            ->make([
                'order_type_id' => $orderType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.order-types.orders.store', $orderType),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($orderType->id, $order->order_type_id);
    }
}
