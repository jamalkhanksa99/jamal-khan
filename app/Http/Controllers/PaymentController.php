<?php
/*
 * File name: PaymentController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use Illuminate\Http\Response;


class PaymentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Payment.
     *
     * @param PaymentDataTable $paymentDataTable
     * @return Response
     */
    public function index(PaymentDataTable $paymentDataTable)
    {
        return $paymentDataTable->render('payments.index');
    }
}
