<?php
/*
 * File name: UnReadCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Notifications;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UnReadCriteria.
 *
 * @package namespace App\Criteria\Notifications;
 */
class UnReadCriteria implements CriteriaInterface
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
        return $model->where('read_at', null);
    }
}
