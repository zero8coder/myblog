<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateArticlesTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function an_user_can_create_new_articles()
    {
        $this->actingAs(factory('App\Models\User')->create());
        $category = factory('App\Models\Category')->create();
        $article = make('App\Models\Article', ['category_id' => $category->id]);
        $response = $this->post("/zero/articles", $article->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($article->title);
    }

    /** @test */
    public function guests_may_not_create_articles()
    {
        $this->withExceptionHandling()
            ->get('/zero/articles/create')
            ->assertRedirect('/zero/login');

        $article = factory('App\Models\Article')->create();
        $this->post("/zero/articles", $article->toArray())
             ->assertRedirect('/zero/login');

    }

    /** @test */
    public function a_article_requires_a_title()
    {
        $this->publishArticle(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_article_requires_a_body()
    {
        $this->publishArticle(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_article_requires_a_valid_category()
    {
        factory('App\Models\Category', 2)->create();

        $this->publishArticle(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this->publishArticle(['category_id' => 999])
            ->assertSessionHasErrors('category_id');
    }

    public function publishArticle($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $article =  make("App\Models\Article", $overrides);

        return $this->post('/zero/articles', $article->toArray());
    }



}
