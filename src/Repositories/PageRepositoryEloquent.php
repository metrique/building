<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\PageRepositoryInterface;

class PageRepositoryEloquent extends EloquentRepositoryAbstract implements PageRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Page';

	/**
	 * The last collected page.
	 * @var Illuminate\Database\Eloquent\Builder
	 */
	protected $page;

	/**
	 * Collection of meta tags from last retrieved page.
	 * @var array
	 */
	protected $meta = [];

	/**
	 * {@inheritdoc}
	 */
	public function bySlug($slug)
	{
		$this->page = $this->model->where(['slug' => $slug, 'published' => 1]);

		if($this->page->count() != 1)
		{
			Throw new \Exception("Page with slug `$slug` doesn't exist.");
		}

		// Store page
		$this->page = $this->page->first();

		// Store meta...
		$this->meta = json_decode($this->page->meta, true);

		return $this->page;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get()
	{
		return $this->page;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMeta($key)
	{
		if(!array_key_exists($key, $this->meta))
		{
			return '';
		}

		return $this->meta[$key];
	}
}