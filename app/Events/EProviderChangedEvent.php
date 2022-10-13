<?php
/**
 * File name: EProviderChangedEvent.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Events;

use App\Models\EProvider;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EProviderChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newEProvider;

    public $oldEProvider;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(EProvider $newEProvider, EProvider $oldEProvider)
    {
        //
        $this->newEProvider = $newEProvider;
        $this->oldEProvider = $oldEProvider;
    }

}
