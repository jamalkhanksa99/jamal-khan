<?php
/*
 * File name: ChangeCustomerRoleToEProvider.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Listeners;

/**
 * Class ChangeCustomerRoleToEProvider
 * @package App\Listeners
 */
class ChangeCustomerRoleToEProvider
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->newEProvider->accepted) {
            foreach ($event->newEProvider->users as $user) {
                $user->syncRoles(['provider']);
            }
        }
    }
}
