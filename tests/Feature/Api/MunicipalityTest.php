<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityTest extends TestCase
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
    public function it_gets_municipalities_list()
    {
        $municipalities = Municipality::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.municipalities.index'));

        $response->assertOk()->assertSee($municipalities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality()
    {
        $data = Municipality::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.municipalities.store'), $data);

        $this->assertDatabaseHas('municipalities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_municipality()
    {
        $municipality = Municipality::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.municipalities.update', $municipality),
            $data
        );

        $data['id'] = $municipality->id;

        $this->assertDatabaseHas('municipalities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_municipality()
    {
        $municipality = Municipality::factory()->create();

        $response = $this->deleteJson(
            route('api.municipalities.destroy', $municipality)
        );

        $this->assertModelMissing($municipality);

        $response->assertNoContent();
    }
}
