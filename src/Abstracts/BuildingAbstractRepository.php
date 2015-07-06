<?php

namespace Metrique\Building\Abstracts;

use Illuminate\Container\Container;
use Metrique\Building\Contracts\BuildingRepositoryInterface;

/**
 * The Abstract Repository provides default implementations of the methods defined
 * in the base repository interface. These simply delegate static function calls 
 * to the right eloquent model based on the $modelClassName.
 */

abstract class BuildingAbstractRepository implements BuildingRepositoryInterface {
    
    protected $model;
    protected $modelClassName;

    public function __construct(Container $app)
    {
        if(is_null($this->modelClassName))
        {
            Throw new \Exception('Model class name is not set.');
        }

        if(!empty($this->modelClassName))
        {
            $this->model = $app->make($this->modelClassName);
        }
    }

    public function create(array $attributes)
    {
        $this->model->create($attributes);
    }

    public function all($columns = array('*'))
    {
        $this->all($columns);
    }

    public function find($id, $columns = array('*'))
    {
        $this->find($id, $columns);
    }
    
    public function destroy($ids)
    {
        $this->destroy($ids);
    }
}