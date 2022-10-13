<?php
/*
 * File name: GalleryRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\Gallery;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GalleryRepository
 * @package App\Repositories
 * @version January 23, 2021, 8:15 pm UTC
 *
 * @method Gallery findWithoutFail($id, $columns = ['*'])
 * @method Gallery find($id, $columns = ['*'])
 * @method Gallery first($columns = ['*'])
 */
class GalleryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'e_provider_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Gallery::class;
    }
}
