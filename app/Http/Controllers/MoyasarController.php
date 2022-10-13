<?php
/*
 * File name: PaymentController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Moyasar\Facades\Payment as MoyasarPayment;

class MoyasarController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'order_id' => 'string|required',
            'order_amount' => 'integer|required',
            'language' => 'string|required',
        ]);

        // Order Details
        $orderID = $request->input('order_id');
        $orderAmount = $request->input('order_amount');
        $orderDescription = 'Service Order #' . $orderID;
        $orderCallbackEndpoint = 'service-order-callback';
        // Language
        $language = $request->input('language');

        return view('moyasar.index', compact('orderID', 'orderAmount', 'orderDescription', 'orderCallbackEndpoint', 'language'));
    }

    public function serviceOrderCallback(Request $request)
    {
        $payment = MoyasarPayment::fetch($request->id);
        if ($payment->id) {

            $orderID = $payment->metadata['order_id'];

            $order = Booking::findorFail($orderID);
            if ($order) {
                if ($order->booking_status_id == 1) {
                    $orderPaymentID = $order->payment_id;
                    $orderPayment = Payment::findorFail($orderPaymentID);
                    if ($orderPayment) {
                        if (($orderPayment->amount * 100) == $payment->amount) {
                            $orderPayment->description = $orderPayment->description . " - Transaction ID: " . $payment->id;
                            if ($payment->status == 'paid') {
                                // Handle success payment
                                $orderPayment->payment_status_id = 2;
                            } else {
                                // Handle failed payment
                                $orderPayment->payment_status_id = 3;
                            }
                        }
                    }
                    $orderPayment->payment_method_id = 7;
                    $orderPayment->save();

                    // Redirect To Payment Result Page
                    app()->setLocale($request->input('language'));
                    $status = $orderPayment->payment_status_id;
                    return view('moyasar.result', compact('status'));
                }
            }
        }
    }
}