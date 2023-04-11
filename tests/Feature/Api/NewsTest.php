<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\News;

use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
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
    public function it_gets_all_news_list()
    {
        $allNews = News::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-news.index'));

        $response->assertOk()->assertSee($allNews[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_news()
    {
        $data = News::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-news.store'), $data);

        $this->assertDatabaseHas('news', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_news()
    {
        $news = News::factory()->create();

        $municipality = Municipality::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text,
            'municipality_id' => $municipality->id,
        ];

        $response = $this->putJson(route('api.all-news.update', $news), $data);

        $data['id'] = $news->id;

        $this->assertDatabaseHas('news', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_news()
    {
        $news = News::factory()->create();

        $response = $this->deleteJson(route('api.all-news.destroy', $news));

        $this->assertModelMissing($news);

        $response->assertNoContent();
    }
}
