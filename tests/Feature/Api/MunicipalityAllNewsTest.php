<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\News;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityAllNewsTest extends TestCase
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
    public function it_gets_municipality_all_news()
    {
        $municipality = Municipality::factory()->create();
        $allNews = News::factory()
            ->count(2)
            ->create([
                'municipality_id' => $municipality->id,
            ]);

        $response = $this->getJson(
            route('api.municipalities.all-news.index', $municipality)
        );

        $response->assertOk()->assertSee($allNews[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality_all_news()
    {
        $municipality = Municipality::factory()->create();
        $data = News::factory()
            ->make([
                'municipality_id' => $municipality->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.municipalities.all-news.store', $municipality),
            $data
        );

        $this->assertDatabaseHas('news', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $news = News::latest('id')->first();

        $this->assertEquals($municipality->id, $news->municipality_id);
    }
}
