<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\BlockRepositoryInterface;

class BlockRepositoryEloquent extends EloquentRepositoryAbstract implements BlockRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Block';

	public function formSelect()
	{
		$form = [];

		foreach($this->all(['id', 'title'], ['title' => 'ASC']) as $key => $value)
		{
			$form[$value->id] = $value->title;
		}

		return $form;
	}
}