<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Intelligence::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Tutorial::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->realText(rand(20, 100)),
        'url' => 'https://www.youtube.com/watch?v=BKorP55Aqvg'
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'url' => 'https://www.youtube.com/watch?v=tGgCqGm_6Hs',
        'message' => $faker->realText(rand(50, 1024))
    ];
});
