<?php
/*
 * File name: CustomPageRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\CustomPage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CustomPageRepository
 * @package App\Repositories
 * @version February 24, 2021, 10:28 am CET
 *
 * @method CustomPage findWithoutFail($id, $columns = ['*'])
 * @method CustomPage find($id, $columns = ['*'])
 * @method CustomPage first($columns = ['*'])
 */
class CustomPageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'published'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomPage::class;
    }
}
