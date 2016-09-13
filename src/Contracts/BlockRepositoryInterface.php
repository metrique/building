<?php

namespace Metrique\Building\Contracts;

use Illuminate\Support\Collection;

interface BlockRepositoryInterface
{
    /**
     * Get all blocks.
     * @return Illuminate\Support\Collection
     */
    public function all();

    /**
     * Find a block.
     * @return mixed
     */
    public function find($id);

    /**
     * Create a block from an array.
     * @return mixed
     */
    public function create(array $data);

    /**
     * Create a block from the request object.
     * @return mixed
     */
    public function createWithRequest();

    /**
     * Destroy a block.
     * @param  int $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Update a block from an array.
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Update a block from the request object.
     * @return mixed
     */
    public function updateWithRequest($id);

    /**
     * Get list of all blocks, formatted for form builder.
     * @return Illuminate\Support\Collection
     */
    public function formBuilderSelect();
}
