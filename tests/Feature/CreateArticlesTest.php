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
        $article = factory('App\Models\Article')->create();
        $this->post("/admin/articles", $article->toArray());
        $this->get($article->path())
            ->assertSee($article->title)
            ->assertSee($article->body);
    }

    /** @test */
    public function guests_may_not_create_articles()
    {
        $this->withExceptionHandling()
            ->get('/admin/articles/create')
            ->assertRedirect('/admin/login');

        $article = factory('App\Models\Article')->create();
        $this->post("/admin/articles", $article->toArray())
             ->assertRedirect('/admin/login');

    }
}
