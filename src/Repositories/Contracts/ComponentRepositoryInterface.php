<?php

namespace Metrique\Building\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ComponentRepositoryInterface
{
    /**
     * Get all components.
     * @return Illuminate\Support\Collection
     */
    public function all();

    /**
     * Find a component.
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

    /**
     * Get list of all components, formatted for form builder.
     * @return Illuminate\Support\Collection
     */
    public function formBuilderSelect();
}
