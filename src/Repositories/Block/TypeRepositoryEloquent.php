<?php

namespace Metrique\Building\Repositories\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Block\TypeRepositoryInterface;

class TypeRepositoryEloquent extends EloquentRepositoryAbstract implements TypeRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\BlockType';

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