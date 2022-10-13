<?php
/*
 * File name: ComplainController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\DataTables\ComplainDataTable;
use App\Http\Requests\UpdateWalletRequest;
use App\Repositories\ComplainRepository;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ComplainController extends Controller
{
    /**
     * @var  ComplainRepository
     */
    private $complainRepository;

    public function __construct(ComplainRepository $complainRepo)
    {
        parent::__construct();
        $this->complainRepository = $complainRepo;
    }

    /**
     * Display a listing of the Wallet.
     *
     * @param ComplainDataTable $complainDataTable
     * @return Response
     */
    public function index(ComplainDataTable $complainDataTable)
    {
        return $complainDataTable->render('complains.index');
    }

    /**
     * Show the form for editing the specified Complain.
     *
     * @param string $id
     *
     * @return Application|Factory|Redirector|RedirectResponse|View
     * @throws RepositoryException
     */
    public function edit(string $id)
    {
        $complain = $this->complainRepository->findWithoutFail($id);
        if (empty($complain)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.complain')]));
            return redirect(route('complains.index'));
        }

        return view('complains.edit')->with('complain', $complain);
    }

    /**
     * Update the specified Complain in storage.
     *
     * @param string $id
     * @param UpdateWalletRequest $request
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(string $id, Request $request)
    {
        $complain = $this->complainRepository->findWithoutFail($id);
        if (empty($complain)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.complain')]));
            return redirect(route('complains.index'));
        }

        try {
            $this->complainRepository->update(['status' => $request->input('status')], $id);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.complain')]));
        return redirect(route('complains.index'));
    }

    /**
     * Remove the specified Complain from storage.
     *
     * @param string $id
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(string $id)
    {
        $complain = $this->complainRepository->findWithoutFail($id);
        if (empty($complain)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.complain')]));

            return redirect(route('complains.index'));
        }
        $this->complainRepository->delete($id);
        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.complain')]));
        return redirect(route('complains.index'));
    }

    /**
     * Remove Media of Complain
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $complain = $this->complainRepository->findWithoutFail($input['id']);
        try {
            if ($complain->hasMedia($input['collection'])) {
                $complain->getFirstMedia($input['collection'])->delete();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
