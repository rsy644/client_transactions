<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Client::class, function ($faker) {
    return [
        'first_name' => Str::random(6),
        'last_name' => Str::random(10),
        'avatar' => \Hash::make('password'), // password
        'email' => $faker->email,
    ];
});
