<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnimalsRepository;
use App\Entities\Animals;
use App\Validators\AnimalsValidator;

/**
 * Class AnimalsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnimalsRepositoryEloquent extends BaseRepository implements AnimalsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Animals::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AnimalsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
