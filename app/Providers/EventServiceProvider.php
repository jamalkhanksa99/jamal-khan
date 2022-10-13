<?php
/*
 * File name: EventServiceProvider.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Providers;

use App\Listeners\SendSmsVerificationCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendSmsVerificationCode::class,
        ],
        'App\Events\EProviderChangedEvent' => [
            'App\Listeners\UpdateEProviderEarningTableListener',
            'App\Listeners\ChangeCustomerRoleToEProvider',
        ],
        'App\Events\UserRoleChangedEvent' => [

        ],
        'App\Events\BookingChangedEvent' => [
            'App\Listeners\UpdateBookingEarningTable'
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
