<?php
/*
 * File name: ComplainRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\Complain;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WalletRepository
 * @package App\Repositories
 * @version August 8, 2021, 1:41 pm CEST
 *
 * @method Complain findWithoutFail($id, $columns = ['*'])
 * @method Complain find($id, $columns = ['*'])
 * @method Complain first($columns = ['*'])
 */
class ComplainRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Complain::class;
    }
}
