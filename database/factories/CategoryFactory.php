<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {

    $word = $faker->word();
    $sentence = $faker->sentence();
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'name' => $word,
        'description'  =>  $sentence,
        'post_count'    => 1,
        'is_show' => 1,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
