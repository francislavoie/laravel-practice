<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->unique()->safeEmail,
        'user_roles_id' => App\Models\UserRole::PUBLIC_USER,
        'password' => 'secret',
        'remember_token' => str_random(10),
    ];
});
