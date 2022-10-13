<?php
/*
 * File name: BookingStatusRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\BookingStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BookingStatusRepository
 * @package App\Repositories
 * @version January 25, 2021, 7:18 pm UTC
 *
 * @method BookingStatus findWithoutFail($id, $columns = ['*'])
 * @method BookingStatus find($id, $columns = ['*'])
 * @method BookingStatus first($columns = ['*'])
 */
class BookingStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'order'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BookingStatus::class;
    }
}
