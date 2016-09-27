<?php

namespace Metrique\Building\Contracts\Page;

interface SectionRepositoryInterface
{
    /**
     * Get all sections.
     * @return Illuminate\Support\Collection
     */
    public function all();

    /**
     * Find a section.
     * @return mixed
     */
    public function find($id);

    /**
     * Finds section regarding the section by page id.
     *
     * @param  int $id
     * @return array
     */
    public function byPageId($id, $order = ['order' => 'desc']);

    /**
     * Finds all information regarding the section by section id, including page details and structure.
     *
     * @param  int $id
     * @return array
     */
    public function findWithAll($id);

    /**
     * Create a section from an array.
     * @return mixed
     */
    public function create(array $data);

    /**
     * Create a section from the request object.
     * @return mixed
     */
    public function createWithRequest();

    /**
     * Destroy a page.
     * @param  int $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Update a page from an array.
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Create a page from the request object.
     * @return mixed
     */
    public function updateWithRequest($id);
}
