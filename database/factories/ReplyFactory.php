<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {

    $sentence = $faker->sentence();
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'nickname' => $faker->name(),
        'email'  =>  $faker->email(),
        'content'    => $sentence,
        'article_id' => function () {
            return factory('App\Models\Article')->create()->id;
        },
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
