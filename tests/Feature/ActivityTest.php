<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Activity;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_article_is_created()
    {
        $this->signIn();

        $article = create('App\Models\Article');

        $this->assertDatabaseHas('activities',[
            'type' => 'created_article',
            'subject_id' => $article->id,
            'subject_type' => 'App\Models\Article'
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id , $article->id);
    }




}
