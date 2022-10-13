<?php
/*
 * File name: AcceptedCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\EProviders;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AcceptedCriteria.
 *
 * @package namespace App\Criteria\EProviders;
 */
class AcceptedCriteria implements CriteriaInterface
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
        return $model->where('e_providers.accepted', '1');
    }
}
