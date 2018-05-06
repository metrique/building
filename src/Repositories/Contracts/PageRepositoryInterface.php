<?php

namespace Metrique\Building\Repositories\Contracts;

interface PageRepositoryInterface
{
    /**
     * Get all pages.
     * @return Illuminate\Support\Collection
     */
    public function all();

    /**
     * Find a page.
     * @return mixed
     */
    public function find($id);

    /**
     * Create a page from an array.
     * @return mixed
     */
    public function create(array $data);

    /**
     * Create a page from the request object.
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

    /**
     * Get the page and meta by slug.
     * @param  strint $slug
     * @return mixed
     */
    public function bySlug($slug);

    /**
     * Get the page and full formatted content by slug.
     * @param  string $slug
     * @return $mixed
     */
    public function contentBySlug($slug);
}
