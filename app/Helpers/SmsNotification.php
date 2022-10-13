<?php

namespace App\Helpers;

use App\Models\SmsNotificationLog;

class SmsNotification
{
    public static function send($receivers, $message, $type, $greeting = true)
    {
        $smsDataArray = [
            "apiver" => "1.0",
            "sms" => [
                "ver" => "2.0",
                "dlr" => [
                    'url' => env('APP_URL') . '/webhooks/sms'
                ],
                "messages" => [
                    [
                        "udh" => 0,
                        "text" => '',
                        "property" => 0,
                        "id" => '',
                        "addresses" => [
                            [
                                "from" => config('valuefirstsms.sender_name'),
                                "to" => '',
                                "seq" => 1,
                                "tag" => ""
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($receivers as $receiver) {
            if ($receiver->phone_number) {
                // Get Correct Phone Number Format
                $phoneNumber = self::fixPhoneNumber($receiver->phone_number);

                // Build SMS Content
                $content = self::buildMessage($receiver, $message, $greeting);
                // Set SMS Content
                $smsDataArray['sms']['messages'][0]['text'] = $content;

                // Create SMS Log
                $smsNotificationLog = SmsNotificationLog::create([
                    'phone_number' => $phoneNumber,
                    'type' => $type,
                    'content' => $content
                ]);
                $smsNotificationLog = $receiver->smsNotificationLog()->save($smsNotificationLog);

                // Set SMS ID
                $smsDataArray['sms']['messages'][0]['id'] = $smsNotificationLog->id;
                // Set SMS Receiver
                $smsDataArray['sms']['messages'][0]['addresses'][0]['to'] = $phoneNumber;

                // Log SMS Request
                $smsNotificationLog->sending_request = json_encode($smsDataArray);
                $smsNotificationLog->save();

                // Execute SMS Sending API
                $response = self::executeSendRequest($smsDataArray);
                // Save SMS API Response
                self::saveRequestResponse($smsNotificationLog, $response);
            }
        }
    }

    private static function buildMessage($receiver, $message, $greeting)
    {
        // Get Message
        $message = (isset($message['data'])) ? trans($message['key'], $message['data']) : trans($message['key']);

        if ($greeting)
            return trans('api.greeting') . $receiver->name . ' ' . $message;

        $message = preg_replace('/(\x{200e}|\x{200f})/u', '', $message);

        return $message;
    }

    private static function fixPhoneNumber($phoneNumber)
    {
        // Remove +
        // Return Full Format Phone Number
        return ltrim($phoneNumber, '+');
    }

    private static function executeSendRequest($smsData)
    {
        // Convert SMS Data Into JSON Format
        $smsData = json_encode($smsData);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.goinfinito.me/unified/v2/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $smsData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . config('valuefirstsms.token'),
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private static function saveRequestResponse($smsNotificationLog, $response)
    {
        $smsNotificationLog->sending_response = $response;

        $responseData = json_decode($response);
        $smsNotificationLog->status = $responseData->status;
        $smsNotificationLog->status_code = $responseData->statuscode;
        $smsNotificationLog->status_text = $responseData->statustext;
        $smsNotificationLog->save();
    }
}
