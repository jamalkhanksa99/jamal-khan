<?php /*
 * File name: FaqCategoryFactory.php

 * Author: DAS360
 * Copyright (c) 2022
 */

/** @noinspection PhpUnusedLocalVariableInspection */

use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Factory;

global $i;
$i = 0;

/** @var Factory $factory */
$factory->define(FaqCategory::class, function () use ($i) {
    $names = ['Service', 'Payment', 'Support', 'Providers', 'Misc'];
    return [
        'name' => $names[$i++],
    ];
});
