<?php
/*
 * File name: CategoryRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\Category;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version January 19, 2021, 2:04 pm UTC
 *
 * @method Category findWithoutFail($id, $columns = ['*'])
 * @method Category find($id, $columns = ['*'])
 * @method Category first($columns = ['*'])
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'color',
        'description',
        'featured',
        'order',
        'parent_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category::class;
    }
}
