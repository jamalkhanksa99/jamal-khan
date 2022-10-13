<?php
/**
 * File name: DeliveryAddressFactory.php

 * Author: DAS360
 * Copyright (c) 2022
 */


use App\Models\DeliveryAddress;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(DeliveryAddress::class, function (Faker $faker) {
    return [
        "description" => $faker->sentence,
        "address" => $faker->address,
        "latitude" => $faker->latitude,
        "longitude" => $faker->longitude,
        "is_default" => $faker->boolean,
        "user_id" => $faker->numberBetween(1, 6),
    ];
});
