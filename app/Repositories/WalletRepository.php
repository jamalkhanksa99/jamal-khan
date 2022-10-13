<?php
/*
 * File name: WalletRepository.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\Wallet;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WalletRepository
 * @package App\Repositories
 * @version August 8, 2021, 1:41 pm CEST
 *
 * @method Wallet findWithoutFail($id, $columns = ['*'])
 * @method Wallet find($id, $columns = ['*'])
 * @method Wallet first($columns = ['*'])
 */
class WalletRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'balance',
        'currency',
        'user_id',
        'enabled'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Wallet::class;
    }
}
