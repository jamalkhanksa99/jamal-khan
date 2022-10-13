<?php
/**
 * File name: EProvidersCustomersCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Users;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EProvidersCustomersCriteria.
 *
 * @package namespace App\Criteria\Users;
 */
class EProvidersCustomersCriteria implements CriteriaInterface
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
        return $model->whereHas("roles", function ($q) {
            $q->where('name', '<>', 'admin');
        });
    }
}
