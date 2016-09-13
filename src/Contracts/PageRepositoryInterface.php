<?php

namespace Metrique\Building\Contracts;

interface PageRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function createWithRequest();
    public function destroy($id);
    public function update($id, array $data);
    public function updateWithRequest($id);

    /**
     * Get the page and meta by slug.
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function bySlug($slug);

    /**
     * Get the page and full formatted content by slug.
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function contentBySlug($slug);

    /**
     * Get meta data from page meta json.
     * For this to be populated the bySlug($slug) method should be called first.
     * By default this will return a blank string.
     *
     * @param  string
     * @return string
     */
    public function getMeta($key);
}
