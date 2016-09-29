<?php

namespace Metrique\Building\Contracts\Component;

use Illuminate\Support\Collection;

interface StructureRepositoryInterface
{
    /**
     * Get structure relating to a component
     * @param  int $id
     * @return Collection
     */
    public function byComponentId($id);

    /**
     * Find a structure.
     * @return mixed
     */
    public function find($id);

    /**
     * Create a component from an array.
     * @return mixed
     */
    public function create(array $data);

    /**
     * Create a component from the request object.
     * @return mixed
     */
    public function createWithRequest();

    /**
     * Destroy a component.
     * @param  int $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Update a component from an array.
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Update a component from the request object.
     * @return mixed
     */
    public function updateWithRequest($id);
}
