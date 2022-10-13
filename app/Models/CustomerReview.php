<?php
/*
 * File name: CustomerReview.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CustomerReview
 * @package App\Models
 * @version January 23, 2021, 7:42 pm UTC
 *
 * @property User user
 * @property CustomerReview customer
 * @property string review
 * @property double rate
 * @property integer user_id
 * @property integer booking_id
 */
class CustomerReview extends Model
{

    public $table = 'customer_reviews';


    public $fillable = [
        'review',
        'rate',
        'user_id',
        'booking_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'review' => 'string',
        'rate' => 'double',
        'booking_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rate' => 'required|numeric|max:5|min:0',
        'user_id' => 'required|exists:users,id',
        'booking_id' => 'required|exists:bookings,id'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',

    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class, setting('custom_field_models', []));
        if (!$hasCustomField) {
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields', 'custom_fields.id', '=', 'custom_field_values.custom_field_id')
            ->where('custom_fields.in_table', '=', true)
            ->get()->toArray();

        return convertToAssoc($array, 'name');
    }

    /**
     * @return BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     **/
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

}
