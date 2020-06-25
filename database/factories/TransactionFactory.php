<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use App\Model;
use Faker\Generator as Faker;

/* Creates faker library and seeds table with dummy data */

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'client_id' => rand(1, App\Client::count()),
        'transaction_date' => $faker->date,
        'amount' => $faker->numberBetween(100, 1000)
    ];
});
