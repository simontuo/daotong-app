<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Suggestion::class, function (Faker $faker) {
    return [
        'is_tourist' => 'T',
        'bio' => $faker->paragraph,
        'markdown_bio' => $faker->paragraph,
    ];
});
