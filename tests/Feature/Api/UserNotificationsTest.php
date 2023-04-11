<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Notification;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserNotificationsTest extends TestCase
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
    public function it_gets_user_notifications()
    {
        $user = User::factory()->create();
        $notifications = Notification::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.notifications.index', $user)
        );

        $response->assertOk()->assertSee($notifications[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_user_notifications()
    {
        $user = User::factory()->create();
        $data = Notification::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.notifications.store', $user),
            $data
        );

        $this->assertDatabaseHas('notifications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $notification = Notification::latest('id')->first();

        $this->assertEquals($user->id, $notification->user_id);
    }
}
