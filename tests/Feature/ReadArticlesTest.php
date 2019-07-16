<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadArticlesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->category = create('App\Models\Category');
        $this->article = create('App\Models\Article', ['category_id' => $this->category->id]);
    }
    /** @test */
    public function a_tourist_can_view_all_articles()
    {
        $this->get('/')
            ->assertSee($this->article->title);
    }

    /** @test */
    public function a_tourist_can_view_a_single_article()
    {
        $this->get($this->article->pathWithoutCategory())
            ->assertSee($this->article->title);
    }

    /** @test */
    public function a_tourist_can_view_a_single_article_with_category()
    {
        $articleWithCateory = create('App\Models\Article', ['category_id' => $this->category->id]);
        $this->get('/categories/' . $this->category->slug . '/articles/' . $articleWithCateory->id)
            ->assertSee($articleWithCateory->title);
    }

    /** @test **/
    public function a_tourist_can_read_replies_that_are_associated_with_a_article()
    {
        $reply = factory('App\Models\Reply')
            ->create(['article_id' => $this->article->id]);
        $this->get($this->article->pathWithoutCategory())
            ->assertSee($reply->content);
    }

    /** @test */
    public function a_article_belongs_to_a_category()
    {
        $this->assertInstanceOf("App\Models\Category", $this->article->category);
    }

    /** @test */
    public function a_article_can_make_a_string_path()
    {
        $this->assertEquals("/articles/{$this->article->category->slug}/{$this->article->id}", $this->article->path());
    }

    /** @test */
    public function a_tourist_can_filter_articles_according_to_a_category()
    {
        $articleInCategory = create("App\Models\Article", ['category_id' => $this->category->id]);
        $category = create('App\Models\Category',['slug' => "xxx"]);
        $articleNotInCategory = create("App\Models\Article", ['category_id' => $category->id]);
        $this->get('/categories/' . $this->category->slug)
            ->assertSee($articleInCategory->title)
            ->assertDontSee($articleNotInCategory->title);
    }


}
