<?php
/*
 * File name: CustomerReviewRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\CustomerReview;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CustomerReviewRepository
 * @package App\Repositories
 * @version January 23, 2021, 7:42 pm UTC
 *
 * @method CustomerReview findWithoutFail($id, $columns = ['*'])
 * @method CustomerReview find($id, $columns = ['*'])
 * @method CustomerReview first($columns = ['*'])
 */
class CustomerReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'rate',
        'user_id',
        'booking_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomerReview::class;
    }
}
