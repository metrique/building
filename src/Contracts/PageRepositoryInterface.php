<?php

namespace Metrique\Building\Contracts;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface PageRepositoryInterface extends EloquentRepositoryAbstractInterface
{
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
	public function contentsBySlug($slug);

	/**
	 * Get meta data from page meta json.
	 * For this to be populated the withSlug($slug) method should be called first.
	 * By default this will return a blank string.
	 * 
	 * @param  string
	 * @return string
	 */
	public function getMeta($key);
}