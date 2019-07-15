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

   /** @test */
   function a_reply_requires_an_email()
   {
       $this->publishReply(['email' => ""])
           ->assertSessionHasErrors('email');

       $this->publishReply(['email' => "812419396Lqq.com"])
           ->assertSessionHasErrors('email');
   }

   /** @test */
   function a_reply_requires_a_content()
   {
       $this->publishReply(['content' => null])
           ->assertSessionHasErrors('content');
   }

   /** @test */
   function a_reply_requires_a_nickname()
   {
       $this->publishReply(['nickname' => null])
           ->assertSessionHasErrors('nickname');
   }

   function publishReply($overrides = [])
   {
       $this->withExceptionHandling();
       $article = create('App\Models\Article');
       $reply = make('App\Models\Reply', $overrides);
       return   $this->post($article->pathWithoutCategory() . '/replies', $reply->toArray());
   }


}
