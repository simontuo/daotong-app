<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Motto::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,5),
        'bio' => $faker->paragraph,
    ];
});
