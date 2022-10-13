<?php
/*
 * File name: NotificationMessage.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FaqCategory
 * @package App\Models
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @property Collection Faq
 * @property string name
 */
class NotificationMessage extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public $table = 'notification_messages';

    public $fillable = [
        'title',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'content' => 'string'
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
    ];
}
