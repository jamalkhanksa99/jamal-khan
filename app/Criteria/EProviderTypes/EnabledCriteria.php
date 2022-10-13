<?php
/*
 * File name: EnabledCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\EProviderTypes;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EnabledCriteria.
 *
 * @package namespace App\Criteria\EProviderTypes;
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
        return $model->where('e_provider_types.disabled', '0');
    }
}
