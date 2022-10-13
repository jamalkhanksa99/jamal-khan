<?php

namespace App\Listeners;

use App\Jobs\SendSmsNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSmsVerificationCode
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
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        // Create Verification Code
        $user->verification_code = rand(100000, 999999);
        $user->save();

        // Send OTP for providers and customers only
        if ($user->hasRole(['provider', 'customer'])) {
            // Check if not verified  yet
            if ($user->email_verified_at == null) {
                // Send SMS
                // Send Verification Code SMS
                $verificationCodeData = [
                    'receivers' => [$user],
                    'message' => ['key' => 'global.account.verification', 'data' => ['code' => $user->verification_code]],
                    'type' => 1,
                    'greeting' => false
                ];
                SendSmsNotification::dispatch($verificationCodeData);
            }
        }
    }
}
