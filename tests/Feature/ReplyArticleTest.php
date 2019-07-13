<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyArticleTest extends TestCase
{
    use DatabaseMigrations;
   /** @test */
   function a_tourist_can_reply_article()
   {
       $article = factory('App\Models\Article')->create();
       $reply = factory('App\Models\Reply')->make();
       $this->post($article->pathWithoutCategory() . '/replies', $reply->toArray());

       $this->get($article->pathWithoutCategory())
           ->assertSee($reply->content);
   }
}
