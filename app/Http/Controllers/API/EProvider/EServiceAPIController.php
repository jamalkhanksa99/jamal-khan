<?php
/*
 * File name: EServiceAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API\EProvider;


use App\Criteria\EServices\EServicesOfUserCriteria;
use App\Criteria\EServices\TypeCriteria;
use App\Http\Controllers\Controller;
use App\Models\EService;
use App\Repositories\EServiceRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
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
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        $eServices = $this->eServiceRepository->all();

        $eServices = array_values($eServices->toArray());

        return $this->sendResponse($eServices, 'Provider Services retrieved successfully');
    }

    /**
     * Display the specified EService.
     * GET|HEAD /eServices/{id}
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     * @throws RepositoryException
     */
    public function show(int $id)
    {
        $this->eServiceRepository->pushCriteria(new EServicesOfUserCriteria(auth()->id()));
        $eService = $this->eServiceRepository->findWithoutFail($id);

        if (empty($eService)) {
            return $this->sendError('EService not found');
        }

        return $this->sendResponse($eService->toArray(), 'EService retrieved successfully');
    }

    /**
     * Store a newly created EService in storage.
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

            $this->validate($request, EService::$rules);

            $input = $request->except('api_token');
            $input['categories'] = isset($input['categories']) ? explode(',', $input['categories']) : [];

            $eService = $this->eServiceRepository->create($input);

            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                    //$mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem = $cacheUpload->media()->first();
                    $mediaItem->copy($eService, 'image');
                }
            }
        } catch (ValidationException $e) {
            return $this->sendError(array_values($e->errors()));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($eService->toArray(), __('lang.saved_successfully', ['operator' => __('lang.e_service')]));
    }

    /**
     * Update the specified EService in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse|mixed
     * @throws RepositoryException
     */
    public function update(int $id, Request $request)
    {
        $this->eServiceRepository->pushCriteria(new EServicesOfUserCriteria(auth()->id()));
        $eService = $this->eServiceRepository->findWithoutFail($id);

        if (empty($eService)) {
            return $this->sendError('E Service not found');
        }
        try {
            $user = auth()->user();
            $providerID = $user->eProviders[0]->id;
            $request->request->add(['e_provider_id' => $providerID]);

            $this->validate($request, EService::$rules);

            $input = $request->except('api_token');
            $input['categories'] = isset($input['categories']) ? explode(',', $input['categories']) : [];

            $eService = $this->eServiceRepository->update($input, $id);

            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                if ($eService->hasMedia('image')) {
                    $eService->getMedia('image')->each->delete();
                }
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    //$mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem = $cacheUpload->media()->first();
                    $mediaItem->copy($eService, 'image');
                }
            }
        } catch (ValidationException $e) {
            return $this->sendError(array_values($e->errors()));
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
     * @throws RepositoryException
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
}
