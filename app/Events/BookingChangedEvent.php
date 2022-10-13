<?php
/*
 * File name: BookingChangedEvent.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eProvider;

    /**
     * BookingChangedEvent constructor.
     * @param $eProvider
     */
    public function __construct($eProvider)
    {
        $this->eProvider = $eProvider;
    }


}
