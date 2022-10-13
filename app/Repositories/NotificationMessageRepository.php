<?php
/**
 * File name: NotificationMessageRepository.php
 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\NotificationMessage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NotificationMessageRepository
 * @package App\Repositories
 * @version September 18, 2022, 9:38 pm UTC
 *
 * @method NotificationMessage findWithoutFail($id, $columns = ['*'])
 * @method NotificationMessage find($id, $columns = ['*'])
 * @method NotificationMessage first($columns = ['*'])
 */
class NotificationMessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NotificationMessage::class;
    }
}
