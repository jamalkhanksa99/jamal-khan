<?php
/*
 * File name: ComplainAPIController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Repositories\ComplainRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class ComplainController
 * @package App\Http\Controllers\API
 */
class ComplainAPIController extends Controller
{
    /**
     * @var ComplainRepository
     */
    private $complainRepository;
    /**
     * @var UploadRepository
     */
    private $uploadRepository;

    public function __construct(ComplainRepository $complainRepository, UploadRepository $uploadRepository)
    {
        parent::__construct();
        $this->complainRepository = $complainRepository;
        $this->uploadRepository = $uploadRepository;
    }

    /**
     * Store a newly created Complain in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function store(Request $request)
    {
        try {
            $request->request->add(['user_id' => auth()->id()]);

            $this->validate($request, Complain::$rules);

            $input = $request->except('api_token');

            $complain = $this->complainRepository->create($input);

            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    //$mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem = $cacheUpload->media()->first();
                    $mediaItem->copy($complain, 'image');
                }
            }
        } catch (ValidationException $e) {
            return $this->sendError(array_values($e->errors()));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($complain->toArray(), __('lang.saved_successfully', ['operator' => __('lang.complain')]));
    }
}
