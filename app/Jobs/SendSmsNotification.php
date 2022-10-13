<?php

namespace App\Jobs;

use App\Helpers\SmsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $smsNotificationData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($smsNotificationData)
    {
        $this->smsNotificationData = $smsNotificationData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        SmsNotification::send($this->smsNotificationData['receivers'], $this->smsNotificationData['message'], $this->smsNotificationData['type'], $this->smsNotificationData['greeting']);

    }
}
