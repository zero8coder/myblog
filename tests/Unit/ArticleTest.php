<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
