<?php
/*
 * File name: EnabledCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Wallets;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EnabledCriteria.
 *
 * @package namespace App\Criteria\Wallets;
 */
class EnabledCriteria implements CriteriaInterface
{
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
        return $model->where('wallets.enabled', '1');
    }
}
