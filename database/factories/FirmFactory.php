<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Firm;
use Faker\Generator as Faker;

$factory->define(Firm::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'code' => $faker->numberBetween(123456789, 299999999),
        'vat_code' => 'LT' . $faker->numberBetween(123456789, 299999999),
        'account' => $faker->bankAccountNumber,
        'city' => $faker->city
    ];
});
