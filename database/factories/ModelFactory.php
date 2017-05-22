<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Flyer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 3,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'country' => strtolower($faker->countrycode),
        'state' => $faker->state,
        'price' => $faker->numberBetween(10000, 10000000),
        'description' => $faker->paragraph(6),
    ];
});
