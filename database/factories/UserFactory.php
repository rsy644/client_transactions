<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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

$factory->define(User::class, function () {
    return [
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => \Hash::make('password'), // password
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
