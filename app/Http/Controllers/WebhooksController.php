<?php

namespace App\Http\Controllers;

use App\Models\SmsNotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhooksController extends Controller
{
    public function smsLog(Request $request)
    {
        $log = $request->all();
        $encodedLog = json_encode($log);

        Log::info('WEBHOOK::SMS - ' . $encodedLog);

        if (isset($log['id'])) {
            $smsID = $log['id'];
            SmsNotificationLog::where('id', $smsID)->update(['webhook_response' => $encodedLog]);
        }
    }
}
