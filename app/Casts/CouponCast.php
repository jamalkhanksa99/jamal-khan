<?php
/*
 * File name: CouponCast.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Casts;

use App\Models\Coupon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 * Class CouponCast
 * @package App\Casts
 */
class CouponCast implements CastsAttributes
{

    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes): Coupon
    {
        if (!empty($value)) {
            $decodedValue = json_decode($value, true);
            $coupon = new Coupon($decodedValue);
            array_push($coupon->fillable, 'id');
            $coupon->id = $decodedValue['id'];
            return $coupon;
        }
        return new Coupon();
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes): array
    {
        if (!$value instanceof Coupon) {
            return ['coupon' => null];
        }

        return [
            'coupon' => json_encode(
                [
                    'id' => $value['id'],
                    'code' => $value['code'],
                    'discount' => $value['discount'],
                    'discount_type' => $value['discount_type'],
                ]
            )
        ];
    }
}
