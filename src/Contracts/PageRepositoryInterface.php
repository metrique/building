<?php

namespace Metrique\Building\Contracts;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface PageRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	/**
	 * Get the page, and contents by slug.
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function bySlug($slug);

	/**
	 * Access to a previously retrieved page.
	 */
	public function get();

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