<?php
/**
 * File name: DeliveryAddressRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\DeliveryAddress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeliveryAddressRepository
 * @package App\Repositories
 * @version December 6, 2019, 1:57 pm UTC
 *
 * @method DeliveryAddress findWithoutFail($id, $columns = ['*'])
 * @method DeliveryAddress find($id, $columns = ['*'])
 * @method DeliveryAddress first($columns = ['*'])
 */
class DeliveryAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'address',
        'latitude',
        'longitude',
        'is_default',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeliveryAddress::class;
    }

    public function initIsDefault($userId)
    {
        DeliveryAddress::where("user_id", $userId)->where("is_default", true)->update(["is_default" => false]);
    }
}
