<?php

namespace Metrique\Building\Contracts;

/**
 * RepositoryInterface provides the standard functions to be expected of ANY repository.
 */
interface BuildingRepositoryInterface {
    
    public function create(array $attributes);

    public function all($columns = array('*'));

    public function find($id, $columns = array('*'));

    public function destroy($ids);

}