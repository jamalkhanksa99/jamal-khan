<?php
/*
 * File name: AddressesOfUserCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Addresses;

use App\Models\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AddressesOfUser.
 *
 * @package namespace App\Criteria\Bookings;
 */
class AddressesOfUserCriteria implements CriteriaInterface
{
    /**
     * @var User
     */
    private $userId;

    /**
     * AddressesOfUser constructor.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $model;
        }
        return $model->where('addresses.user_id', $this->userId);
    }
}

