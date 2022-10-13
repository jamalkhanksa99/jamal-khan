<?php
/*
 * File name: CustomerReviewController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\DataTables\CustomerReviewDataTable;
use App\Repositories\CustomerReviewRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Prettus\Repository\Exceptions\RepositoryException;

class CustomerReviewController extends Controller
{
    /**
     * @var
     * CustomerReviewRepository
     */
    private $customerReviewRepository;

    public function __construct(CustomerReviewRepository $customerReviewRepo)
    {
        parent::__construct();
        $this->customerReviewRepository = $customerReviewRepo;
    }

    /**
     * Display a listing of the CustomerReview.
     *
     * @param CustomerReviewDataTable $customerReviewDataTable
     * @return Response
     */
    public function index(CustomerReviewDataTable $customerReviewDataTable)
    {
        return $customerReviewDataTable->render('customer_reviews.index');
    }

    /**
     * Display the specified CustomerReview.
     *
     * @param int $id
     *
     * @return Application|Factory|Response|View
     * @throws RepositoryException
     */
    public function show($id)
    {
        $customerReview = $this->customerReviewRepository->findWithoutFail($id);

        if (empty($customerReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.customer_review')]));
            return redirect(route('customerReviews.index'));
        }
        return view('customer_reviews.show')->with('customerReview', $customerReview);
    }

    /**
     * Remove the specified CustomerReview from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Redirector|Response
     */
    public function destroy(int $id)
    {
        $customerReview = $this->customerReviewRepository->findWithoutFail($id);

        if (empty($customerReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.customer_review')]));
            return redirect(route('customerReviews.index'));
        }

        $this->customerReviewRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.customer_review')]));
        return redirect(route('customerReviews.index'));
    }
}
