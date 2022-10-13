<?php
/*
 * File name: DistinctCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Favorites;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class DistinctCriteria.
 *
 * @package namespace App\Criteria\Favorites;
 */
class DistinctCriteria implements CriteriaInterface
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
        return $model->groupBy('e_service_id');
    }
}
