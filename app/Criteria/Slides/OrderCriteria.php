<?php
/*
 * File name: OrderCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Slides;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderCriteria.
 *
 * @package namespace App\Criteria\Slides;
 */
class OrderCriteria implements CriteriaInterface
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
        return $model->orderBy('slides.order', 'asc');
    }
}
