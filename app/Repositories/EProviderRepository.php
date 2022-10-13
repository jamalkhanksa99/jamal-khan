<?php
/*
 * File name: EProviderRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\EProvider;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EProviderRepository
 * @package App\Repositories
 * @version January 13, 2021, 11:11 am UTC
 *
 * @method EProvider findWithoutFail($id, $columns = ['*'])
 * @method EProvider find($id, $columns = ['*'])
 * @method EProvider first($columns = ['*'])
 */
class EProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'e_provider_type_id',
        'description',
        'phone_number',
        'mobile_number',
        'availability_range',
        'available',
        'featured'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EProvider::class;
    }
}
