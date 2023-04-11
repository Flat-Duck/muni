<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityOrdersTest extends TestCase
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
    public function it_gets_municipality_orders()
    {
        $municipality = Municipality::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'municipality_id' => $municipality->id,
            ]);

        $response = $this->getJson(
            route('api.municipalities.orders.index', $municipality)
        );

        $response->assertOk()->assertSee($orders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality_orders()
    {
        $municipality = Municipality::factory()->create();
        $data = Order::factory()
            ->make([
                'municipality_id' => $municipality->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.municipalities.orders.store', $municipality),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($municipality->id, $order->municipality_id);
    }
}
