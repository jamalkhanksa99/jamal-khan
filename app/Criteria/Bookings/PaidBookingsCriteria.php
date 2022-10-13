<?php
/*
 * File name: PaidBookingsCriteria.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Criteria\Bookings;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PaidBookingsCriteria.
 *
 * @package namespace App\Criteria\Bookings;
 */
class PaidBookingsCriteria implements CriteriaInterface
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
        return $model->join('payments', 'payments.id', '=', 'bookings.payment_id')
            ->where('payments.payment_status_id', '2') // Paid Id
            ->groupBy('bookings.id')
            ->select('bookings.*');

    }
}
