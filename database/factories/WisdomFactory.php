<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Wisdom::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence(),
        'author' => $faker->name,
    ];
});
