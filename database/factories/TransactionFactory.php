<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'client_id' => rand(1, App\Client::count()),
        'transaction_date' => $faker->date,
        'amount' => $faker->numberBetween(100, 1000)
    ];
});
