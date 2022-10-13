<?php

namespace App\Criteria\EServices;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TypeCriteria.
 *
 * @package namespace App\Criteria\EServices;
 */
class TypeCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * NearCriteria constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->request->has('type')) {
            $type = $this->request->get('type');
            if (in_array($type, ['in_center', 'in_home']))
                return $model->where('e_services.' . $type, '1');
        }
        return $model;
    }
}
