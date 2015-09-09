<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface;

class ContentRepositoryEloquent extends EloquentRepositoryAbstract implements ContentRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Page\Content';

	public function bySectionId($id)
	{
		$this->model = $this->model->where(['building_page_sections_id' => $id]);

		return $this->model;
	}
}