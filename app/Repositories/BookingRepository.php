<?php
/*
 * File name: BookingRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\Booking;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BookingRepository
 * @package App\Repositories
 * @version January 25, 2021, 9:22 pm UTC
 *
 * @method Booking findWithoutFail($id, $columns = ['*'])
 * @method Booking find($id, $columns = ['*'])
 * @method Booking first($columns = ['*'])
 */
class BookingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'e_provider',
        'e_service',
        'options',
        'user_id',
        'booking_status_id',
        'address',
        'payment_id',
        'coupon',
        'taxes',
        'booking_at',
        'start_at',
        'ends_at',
        'hint',
        'booking_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Booking::class;
    }
}
