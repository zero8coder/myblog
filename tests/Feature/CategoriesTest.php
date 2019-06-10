<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_tourist_can_view_articles_by_category()
    {
        $category = factory('App\Models\Category')->create();
        $article = factory('App\Models\Article')->create(['category_id' => $category->id]);

        $response = $this->get('/categories/' . $category->id);
        $response->assertSee($article->title);
    }

}
