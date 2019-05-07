<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'content' => $faker->text(200),
        'status' => $faker->boolean(0,1)
    ];
});
