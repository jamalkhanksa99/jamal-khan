<?php
/*
 * File name: VerifyCsrfToken.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'payments/razorpay/*'
    ];
}
