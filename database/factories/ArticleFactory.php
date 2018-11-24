<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {

    $sentence = $faker->sentence();

    $updated_at = $faker->dateTimeThisMonth();

    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'title'      => $sentence,
        'body'       => $faker->text(),
        'is_show'    => 1,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
