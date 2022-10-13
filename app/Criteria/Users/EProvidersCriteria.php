<?php
/**
 * File name: EProvidersCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Users;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EProvidersCriteria.
 *
 * @package namespace App\Criteria\Users;
 */
class EProvidersCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereHas("roles", function($q){ $q->where("name", "provider"); });
    }
}
