<?php

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->realText(60, 3),
        'user_id' => \App\Models\User::whereIn('user_roles_id', [1, 2])->get()->random()->id,
        'published' => 1,
        'content' => $faker->realText(1000, 3),
        'published_at' => $faker->date("Y-m-d H:i:s", $max = 'now'),
    ];
});
