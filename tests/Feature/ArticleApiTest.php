<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\ActingJWTUser;

class ArticleApiTest extends TestCase
{
    protected $user;
    use ActingJWTUser;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testStoreArticle()
    {
        $data = ['category_id' => 1, 'body' => 'test body', 'title' => 'test title'];

        $response = $this->JWTActingAs($this->user)
            ->json('POST', '/api/articles/', $data);

        $assertData = [
            'category_id' => 1,
            'title' => 'test title',
            'body' => 'test body',
        ];

        $response->assertStatus(201)
            ->assertJsonFragment($assertData);

    }

    public function testUpdateArticle()
    {
        $article = $this->makeArticle();

        $editData = ['category_id' => 2, 'body' => 'edit body', 'title' => 'edit title'];

        $response = $this->JWTActingAs($this->user)
            ->json('PATCH', '/api/articles/'.$article->id, $editData);

        $assertData = [
            'category_id' => 2,
            'title' => 'edit title',
            'body' => 'edit body',
        ];

        $response->assertStatus(200)
            ->assertJsonFragment($assertData);
    }

    public function testShowArticle()
    {
        $article = $this->makeArticle();
        $response = $this->json('GET', '/api/articles/'.$article->id);

        $assertData = [
            'category_id' => $article->category_id,
            'title' =>  $article->title,
            'body' =>  $article->body,
        ];

        $response->assertStatus(200)
            ->assertJsonFragment($assertData);
    }

    public function testIndexArticle()
    {
        $response = $this->json('GET', '/api/articles');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'meta']);

    }

    public function testDeleteArticle()
    {
        $article = $this->makeArticle();
        $response = $this->JWTActingAs($this->user)
            ->json('DELETE', '/api/articles/'.$article->id);
        $response->assertStatus(204);

        $response = $this->json('GET', '/api/articles/'.$article->id);
        $response->assertStatus(404);
    }

    protected function makeArticle()
    {
        return factory(Article::class)->create([
            'category_id' => 1,
        ]);
    }
}
