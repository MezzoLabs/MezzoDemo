<?php

use App\Tutorial;
use App\User;

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

$factory->define(User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Tutorial::class, function(Faker\Generator $faker){
    $users = User::all()->lists('id');

    $tutorials = Tutorial::all()->lists('id');

    $parent = NULL;
    if(rand(0,10) < 6 && $tutorials->count() > 0)
        $parent = $tutorials->random();

    $array = [
        'title' => $faker->text(30),
        'body' => $faker->text(200),
        'user_id' => $users->random()
    ];

    if ($parent)
        $array['parent'] = $parent;

    return $array;
});
