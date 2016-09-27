<?php

namespace Metrique\Building\Contracts\Block;

use Illuminate\Support\Collection;

interface StructureRepositoryInterface
{
    /**
     * Get structure relating to a block
     * @param  int $id
     * @return Collection
     */
    public function byBlockId($id);

    /**
     * Find a structure.
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
}
