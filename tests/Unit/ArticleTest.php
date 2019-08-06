<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Activity;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->article = factory("App\Models\Article")->create();
    }

    /** @test */
    public function a_article_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->article->replies);
    }

    /** @test */
    public function a_article_can_add_a_reply()
   {
       $this->article->addReply([
           'content' => "good",
           'nickname' => "zero",
           'email' => "812412222@qq.com"
       ]);

       $this->assertCount(1, $this->article->replies);

   }

   /** @test */
   public function a_article_belongs_to_a_category()
   {
       $category = create('App\Models\Category');

       $article = create("App\Models\Article", ['category_id' => $category->id]);

       $this->assertInstanceOf('App\Models\Category', $article->category);
   }


    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create('App\Models\Reply');

        $this->assertEquals(3, Activity::count());
    }
}