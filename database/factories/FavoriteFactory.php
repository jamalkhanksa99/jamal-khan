<?php
/**
 * File name: FavoriteFactory.php

 * Author: DAS360
 * Copyright (c) 2022
 */


use App\Models\Favorite;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'eservice_id' => $faker->numberBetween(1, 30),
        'user_id' => $faker->numberBetween(1, 6)
    ];
});
