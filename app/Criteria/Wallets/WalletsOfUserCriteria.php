<?php
/*
 * File name: WalletsOfUserCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Wallets;

use App\Models\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class WalletsOfUserCriteria.
 *
 * @package namespace App\Criteria\Options;
 */
class WalletsOfUserCriteria implements CriteriaInterface
{

    /**
     * @var User
     */
    private $userId;

    /**
     * WalletsOfUserCriteria constructor.
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
        if (auth()->check() && !auth()->user()->hasRole('admin')) {
            return $model->where('wallets.user_id', $this->userId);
        } else {
            return $model;
        }
    }
}
