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
	public function contentBySlug($slug)
	{
		$contentRepository = $this->app->make('Metrique\Building\Contracts\Page\ContentRepositoryInterface');
		$sectionRepository = $this->app->make('Metrique\Building\Contracts\Page\SectionRepositoryInterface');

		// Find sectinos by slug.
		$sections = $sectionRepository->byPageId($this->bySlug($slug)->id);

		foreach($sections as $section)
		{
			dump($sectionRepository->findWithAll($section['id']));
		}
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