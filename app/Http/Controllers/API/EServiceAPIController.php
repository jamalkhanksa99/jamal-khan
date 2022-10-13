<?php
/*
 * File name: EServiceAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API;


use App\Criteria\EServices\EServicesOfUserCriteria;
use App\Criteria\EServices\NearCriteria;
use App\Criteria\EServices\TypeCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEServiceRequest;
use App\Http\Requests\UpdateEServiceRequest;
use App\Repositories\EServiceRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Nwidart\Modules\Facades\Module;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class EServiceController
 * @package App\Http\Controllers\API
 */
class EServiceAPIController extends Controller
{
    /** @var  eServiceRepository */
    private $eServiceRepository;
    /** @var UserRepository */
    private $userRepository;
    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    private $availableSlots = [];
    private $futureDateStart = false;
    private $futureTimeSlotStart = false;

    public function __construct(EServiceRepository $eServiceRepo, UserRepository $userRepository, UploadRepository $uploadRepository)
    {
        parent::__construct();
        $this->eServiceRepository = $eServiceRepo;
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
    }

    /**
     * Display a listing of the EService.
     * GET|HEAD /eServices
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->eServiceRepository->pushCriteria(new RequestCriteria($request));
            $this->eServiceRepository->pushCriteria(new EServicesOfUserCriteria(auth()->id()));
            $this->eServiceRepository->pushCriteria(new TypeCriteria($request));
            $this->eServiceRepository->pushCriteria(new NearCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $eServices = $this->eServiceRepository->all();

        $this->availableEServices($eServices);
        $this->availableEProvider($request, $eServices);
        $this->hasValidSubscription($request, $eServices);
        $this->orderByRating($request, $eServices);
        $this->limitOffset($request, $eServices);
        $this->filterCollection($request, $eServices);
        $eServices = array_values($eServices->toArray());

        return $this->sendResponse($eServices, 'E Services retrieved successfully');
    }

    /**
     * @param Collection $eServices
     */
    private function availableEServices(Collection &$eServices)
    {
        $eServices = $eServices->where('available', true);
    }

    /**
     * @param Request $request
     * @param Collection $eServices
     */
    private function availableEProvider(Request $request, Collection &$eServices)
    {
        if ($request->has('available_e_provider')) {
            $eServices = $eServices->filter(function ($element) {
                return $element->eProvider->available;
            });
        }
    }

    /**
     * @param Request $request
     * @param Collection $eServices
     */
    private function hasValidSubscription(Request $request, Collection &$eServices)
    {
        if (Module::isActivated('Subscription')) {
            $eServices = $eServices->filter(function ($element) {
                return $element->eProvider->hasValidSubscription && $element->eProvider->accepted;
            });
        } else {
            $eServices = $eServices->filter(function ($element) {
                return $element->eProvider->accepted;
            });
        }
    }

    /**
     * @param Request $request
     * @param Collection $eServices
     */
    private function orderByRating(Request $request, Collection &$eServices)
    {
        if ($request->has('rating')) {
            $eServices = $eServices->sortBy('rate', SORT_REGULAR, true);
        }
    }

    /**
     * Display the specified EService.
     * GET|HEAD /eServices/{id}
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $this->eServiceRepository->pushCriteria(new RequestCriteria($request));
            $this->eServiceRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $eService = $this->eServiceRepository->findWithoutFail($id);
        if (empty($eService)) {
            return $this->sendError('EService not found');
        }
        if ($request->has('api_token')) {
            $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
            if (!empty($user)) {
                auth()->login($user, true);
            }
        }
        $this->filterModel($request, $eService);

        return $this->sendResponse($eService->toArray(), 'EService retrieved successfully');
    }

    /**
     * Store a newly created EService in storage.
     *
     * @param CreateEServiceRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateEServiceRequest $request): JsonResponse
    {
        try {
            $input = $request->all();
            $eService = $this->eServiceRepository->create($input);
            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($eService, 'image');
                }
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($eService->toArray(), __('lang.saved_successfully', ['operator' => __('lang.e_service')]));
    }

    /**
     * Update the specified EService in storage.
     *
     * @param int $id
     * @param UpdateEServiceRequest $request
     *
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function update(int $id, UpdateEServiceRequest $request): JsonResponse
    {
        $this->eServiceRepository->pushCriteria(new EServicesOfUserCriteria(auth()->id()));
        $eService = $this->eServiceRepository->findWithoutFail($id);

        if (empty($eService)) {
            return $this->sendError('E Service not found');
        }
        try {
            $input = $request->all();
            $input['categories'] = isset($input['categories']) ? $input['categories'] : [];
            $eService = $this->eServiceRepository->update($input, $id);
            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                if ($eService->hasMedia('image')) {
                    $eService->getMedia('image')->each->delete();
                }
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($eService, 'image');
                }
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($eService->toArray(), __('lang.updated_successfully', ['operator' => __('lang.e_service')]));
    }

    /**
     * Remove the specified EService from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->eServiceRepository->pushCriteria(new EServicesOfUserCriteria(auth()->id()));
        $eService = $this->eServiceRepository->findWithoutFail($id);

        if (empty($eService)) {
            return $this->sendError('EService not found');
        }

        $eService = $this->eServiceRepository->delete($id);

        return $this->sendResponse($eService, __('lang.deleted_successfully', ['operator' => __('lang.e_service')]));

    }

    /**
     * Remove Media of EService
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        try {
            $this->eServiceRepository->pushCriteria(new EServicesOfUserCriteria(auth()->id()));
            $eService = $this->eServiceRepository->findWithoutFail($input['id']);
            if ($eService->hasMedia($input['collection'])) {
                $eService->getFirstMedia($input['collection'])->delete();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function slots(Request $request, int $id)
    {
        $eService = $this->eServiceRepository->findWithoutFail($id);
        if (empty($eService)) {
            return $this->sendError('EService not found');
        }

        // Current DateTime
        $currentDate = Carbon::now()->startOfDay();
        // Booking Date
        $date = $request->input('date');
        $bookingDate = Carbon::parse($date)->startOfDay();

        if ($bookingDate->lt($currentDate))
            return $this->sendError('Booking date cannot be in past');

        // Retrieve Day Name From Date
        $dayName = $bookingDate->locale('en')->dayName;
        $dayName = strtolower($dayName);

        // Service Interval
        $interval = $eService->duration;

        // Provider
        $provider = $eService->eProvider;

        // Available Slots For Selected Date
        $availableHours = $provider->availabilityHours()->where('day', '=', $dayName)->get();

        // Creating Time Slots
        foreach ($availableHours as $availableHour) {
            if (!$this->futureDateStart) {
                $endDate = Carbon::createFromFormat('Y-m-d H:i', $date . " " . $availableHour->end_at);
                $this->futureDateStart = !$endDate->isPast();
            }
            if ($this->futureDateStart)
                $this->generateSLots($date, $availableHour->start_at, $availableHour->end_at, $interval);
        }

        return $this->sendResponse($this->availableSlots, __('lang.retrieved_successfully', ['operator' => __('lang.service_available_slots')]));
    }

    private function generateSLots($date, $start_time, $end_time, $interval): void
    {
        $day_start = Carbon::parse($start_time);
        $day_end = Carbon::parse($end_time);

        $add_minute = Carbon::parse($interval)->minute;
        $add_hour = Carbon::parse($interval)->hour;

        $slot_start = $day_start;
        $slot_end = Carbon::parse($start_time);
        $slot_end = $slot_end->addMinutes($add_minute);
        $slot_end = $slot_end->addHours($add_hour);

        while ($slot_end->lte($day_end)) {
            // Check For First Future Time Slot
            if (!$this->futureTimeSlotStart) {
                $timeSlot = Carbon::createFromFormat('Y-m-d H:i', $date . " " . $slot_start->format('H:i'));
                $this->futureTimeSlotStart = !$timeSlot->isPast();
            }
            if ($this->futureTimeSlotStart) {
                // Fill Slots
                $this->availableSlots[] = [
                    'display' => $slot_start->format('g:i A') . '-' . $slot_end->format('g:i A'),
                    'data' => [
                        'start_time' => $slot_start->format('H:i'),
                        'end_time' => $slot_end->format('H:i')
                    ]
                ];
            }

            // Prepare For Next Iteration
            $slot_start = $slot_start->addMinutes($add_minute);
            $slot_start = $slot_start->addHours($add_hour);

            $slot_end = $slot_end->addMinutes($add_minute);
            $slot_end = $slot_end->addHours($add_hour);
        }
    }

}
