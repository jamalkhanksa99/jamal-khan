<?php
/*
 * File name: CustomerReviewAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API\EProvider;


use App\Http\Controllers\Controller;
use App\Repositories\BookingRepository;
use App\Repositories\CustomerReviewRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class EServiceReviewController
 * @package App\Http\Controllers\API
 */
class CustomerReviewAPIController extends Controller
{
    /**
     * @var  CustomerReviewRepository
     */
    private $customerReviewRepository;

    /**
     * @var  BookingRepository
     */
    private $bookingRepository;

    public function __construct(CustomerReviewRepository $customerReviewRepo, BookingRepository $bookingRepo)
    {
        $this->customerReviewRepository = $customerReviewRepo;
        $this->bookingRepository = $bookingRepo;
    }

    /**
     * Store a newly created Review in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(int $id, Request $request): JsonResponse
    {
        $userID = auth()->id();
        $booking = $this->bookingRepository->findWithoutFail($id);
        if (empty($booking)) {
            return $this->sendError('Booking not found');
        }
        if ($userID != $booking->e_provider->users[0]->id)
            return $this->sendError('Booking not found');

        $uniqueInput = ['user_id' => auth()->id(), 'booking_id' => $id];
        $otherInput = ['review' => $request->input('review'), 'rate' => $request->input('rate')];

        try {
            $review = $this->customerReviewRepository->updateOrCreate($uniqueInput, $otherInput);
        } catch (ValidatorException $e) {
            return $this->sendError(__('lang.not_found', ['operator' => __('lang.customer_review')]));
        }

        return $this->sendResponse($review->toArray(), __('lang.saved_successfully', ['operator' => __('lang.customer_review')]));
    }
}
