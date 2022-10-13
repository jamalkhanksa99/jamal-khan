<?php
/*
 * File name: AccountVerificationAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendSmsNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountVerificationAPIController extends Controller
{
    public function verifyAccount(Request $request)
    {
        $user = auth()->user();

        if ($user->verification_code == $request->verification_code) {
            $user->email_verified_at = date('Y-m-d h:m:s');
            $user->verification_code = null;
            $user->save();
            return response()->json(['message' => 'Your Account Has Been Verified Successfully'], Response::HTTP_ACCEPTED);
        } else
            return response()->json(['message' => 'Invalid Verification Code'], Response::HTTP_NOT_ACCEPTABLE);
    }

    public function resendCode(Request $request)
    {
        $user = auth()->user();

        $user->verification_code = rand(100000, 999999);
        $user->save();

        // Send SMS Notification
        $smsNotificationData = [
            'receivers' => [$user],
            'message' => ['key' => 'api.account.verification', 'data' => ['code' => $user->verification_code]],
            'type' => 1,
            'greeting' => false
        ];
        SendSmsNotification::dispatch($smsNotificationData);

        return response()->json(['message' => 'Your Account Verification Code Sent'], Response::HTTP_ACCEPTED);
    }
}
