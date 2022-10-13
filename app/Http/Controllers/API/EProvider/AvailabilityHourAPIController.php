<?php
/*
 * File name: AvailabilityHourAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API\EProvider;


use App\Criteria\AvailabilityHours\AvailabilityHoursOfUserCriteria;
use App\Http\Controllers\Controller;
use App\Models\AvailabilityHour;
use App\Repositories\AvailabilityHourRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class AvailabilityHourController
 * @package App\Http\Controllers\API
 */
class AvailabilityHourAPIController extends Controller
{
    /** @var  AvailabilityHourRepository */
    private $availabilityHourRepository;


    public function __construct(AvailabilityHourRepository $availabilityHourRepo)
    {
        $this->availabilityHourRepository = $availabilityHourRepo;
    }


    /**
     * Display a listing of the AvailabilityHour.
     * GET|HEAD /availabilityHours
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->availabilityHourRepository->pushCriteria(new AvailabilityHoursOfUserCriteria(auth()->id()));
            $this->availabilityHourRepository->pushCriteria(new RequestCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $availabilityHours = $this->availabilityHourRepository->all();

        return $this->sendResponse($availabilityHours->toArray(), 'Availability Hours retrieved successfully');
    }

    /**
     * Display the specified Availability Hour.
     * GET|HEAD /availabilityHours/{id}
     *
     * @param int $id
     * @return JsonResponse|mixed
     * @throws RepositoryException
     */
    public function show(int $id)
    {
        $this->availabilityHourRepository->pushCriteria(new AvailabilityHoursOfUserCriteria(auth()->id()));
        $availabilityHour = $this->availabilityHourRepository->findWithoutFail($id);

        if (empty($availabilityHour)) {
            return $this->sendError('Availability Hour not found');
        }

        return $this->sendResponse($availabilityHour->toArray(), 'Availability Hour retrieved successfully');
    }

    /**
     * Store a newly created Availability Hour in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $providerID = $user->eProviders[0]->id;
            $request->request->add(['e_provider_id' => $providerID]);

            $this->validate($request, AvailabilityHour::$rules);

            if (!in_array(strtolower($request->input('day')), AvailabilityHour::$DAYS))
                return $this->sendError('Invalid Day');

            $input = $request->except('api_token');

            $this->availabilityHourRepository->pushCriteria(new AvailabilityHoursOfUserCriteria(auth()->id()));

            $hasConflict = $this->conflictCheck($input);
            if ($hasConflict)
                return $this->sendError('Availability Hour conflict');

            $availabilityHour = $this->availabilityHourRepository->create($input);
        } catch (ValidationException $e) {
            return $this->sendError(array_values($e->errors()));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($availabilityHour->toArray(), __('lang.saved_successfully', ['operator' => __('lang.availability_hour')]));
    }

    /**
     * Update the specified Availability Hour in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse|mixed
     * @throws RepositoryException
     */
    public function update(int $id, Request $request)
    {
        $this->availabilityHourRepository->pushCriteria(new AvailabilityHoursOfUserCriteria(auth()->id()));
        $availabilityHour = $this->availabilityHourRepository->findWithoutFail($id);

        if (empty($availabilityHour)) {
            return $this->sendError('Availability Hour not found');
        }
        try {
            $user = auth()->user();
            $providerID = $user->eProviders[0]->id;
            $request->request->add(['e_provider_id' => $providerID]);

            $this->validate($request, AvailabilityHour::$rules);

            if (!in_array(strtolower($request->input('day')), AvailabilityHour::$DAYS))
                return $this->sendError('Invalid Day');

            $input = $request->except('api_token');

            $hasConflict = $this->conflictCheck($input);
            if ($hasConflict)
                return $this->sendError('Availability Hour conflict');

            $availabilityHour = $this->availabilityHourRepository->update($input, $id);
        } catch (ValidationException $e) {
            return $this->sendError(array_values($e->errors()));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($availabilityHour->toArray(), __('lang.updated_successfully', ['operator' => __('lang.availability_hour')]));
    }

    /**
     * Remove the specified Availability Hour from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->availabilityHourRepository->pushCriteria(new AvailabilityHoursOfUserCriteria(auth()->id()));
        $availabilityHour = $this->availabilityHourRepository->findWithoutFail($id);

        if (empty($availabilityHour)) {
            return $this->sendError('Availability Hour not found');
        }

        $availabilityHour = $this->availabilityHourRepository->delete($id);

        return $this->sendResponse($availabilityHour, __('lang.deleted_successfully', ['operator' => __('lang.availability_hour')]));
    }

    private function conflictCheck($data)
    {
        return $this->availabilityHourRepository->findWhere([
            'day' => $data['day'],
            ['start_at', '<', $data['end_at']],
            ['end_at', '>', $data['start_at']]
        ])->count();
    }
}
