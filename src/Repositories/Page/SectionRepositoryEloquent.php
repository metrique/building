<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface;

class SectionRepositoryEloquent extends EloquentRepositoryAbstract implements SectionRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Page\Section';

	public function withPageId($id, $order = ['order' => 'DESC'])
	{
		return $this->orderBy($order)->where(['building_pages_id' => $id])->get();
	}
}