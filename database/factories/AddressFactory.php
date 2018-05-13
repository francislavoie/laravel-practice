<?php

$factory->define(App\Models\UserAddress::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory('App\User')->create(),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'province' => $faker->state,
        'country' => $faker->country,
        'postal_code' => $faker->postcode,
    ];
});
