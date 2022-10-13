<?php
/*
 * File name: PaymentStatusAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use App\Repositories\PaymentStatusRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class PaymentStatusController
 * @package App\Http\Controllers\API
 */
class PaymentStatusAPIController extends Controller
{
    /** @var  PaymentStatusRepository */
    private $paymentStatusRepository;

    public function __construct(PaymentStatusRepository $paymentStatusRepo)
    {
        $this->paymentStatusRepository = $paymentStatusRepo;
    }

    /**
     * Display a listing of the PaymentStatus.
     * GET|HEAD /paymentStatuses
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->paymentStatusRepository->pushCriteria(new RequestCriteria($request));
            $this->paymentStatusRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $paymentStatuses = $this->paymentStatusRepository->all();

        return $this->sendResponse($paymentStatuses->toArray(), 'Payment Statuses retrieved successfully');
    }

    /**
     * Display the specified PaymentStatus.
     * GET|HEAD /paymentStatuses/{id}
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        /** @var PaymentStatus $paymentStatus */
        if (!empty($this->paymentStatusRepository)) {
            $paymentStatus = $this->paymentStatusRepository->findWithoutFail($id);
        }

        if (empty($paymentStatus)) {
            return $this->sendError('Payment Status not found');
        }

        return $this->sendResponse($paymentStatus->toArray(), 'Payment Status retrieved successfully');
    }
}
