<?php

namespace Metrique\Building\Abstracts;

use Illuminate\Container\Container;

/**
 * The Abstract Repository provides default implementations of the methods defined
 * in the base repository interface. These simply delegate static function calls 
 * to the right eloquent model based on the $modelClassName.
 * 
 */
abstract class EloquentRepositoryAbstract implements EloquentRepositoryAbstractInterface {
    
    protected $model;
    protected $modelClassName;

    /**
     * [__construct description]
     * @param Container $app 
     */
    public function __construct(Container $app)
    {
        if(is_null($this->modelClassName))
        {
            Throw new \Exception('Model class name is not set.');
        }

        $this->model = $app->make($this->modelClassName);

        return $this;
    }

    public function all(array $columns = ['*'], array $order = [])
    {
        if(count($order) > 0)
        {
            foreach($order as $key => $value)
            {
                $this->model = $this->model->orderBy($key, $value);
            }

            return $this->model->get();
        }

        return $this->model->all($columns);
    }

    public function paginate($perPage = 10, array $columns = ['*'], array $order = [])
    {
        if(count($order) > 0)
        {
            foreach($order as $key => $value)
            {
                $this->model = $this->model->orderBy($key, $value);
            }

            return $this->model->get();
        }
        
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        $create = $this->model->create($data);

        if(!$create)
        {
            Throw new \Exception('Model was not created.');
        }

        return $create;
    }

    public function update($id, array $data)
    {
        $update = $this->model->find($id)->update($data);

        if(!$update)
        {
            Throw new \Exception('Model was not updated.');
        }

        return $update;
    }

    public function find($id, array $columns = ['*'], $fail = true)
    {
        if($fail)
        {
            return $this->model->findOrFail($id, $columns);
        }
        
        return $this->model->find($id, $columns);
    }

    public function destroy($id)
    {
        $destroy = $this->model->destroy($id);

        if(!$destroy)
        {
            Throw new \Exception('Model was not be deleted.');
        }

        return $destroy;
    }
}