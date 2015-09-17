<?php

namespace Metrique\Building\Repositories\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Block\StructureRepositoryInterface;

class StructureRepositoryEloquent extends EloquentRepositoryAbstract implements StructureRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Block\Structure';

	public function byBlockId($id, $order = ['order' => 'desc'])
	{
		return $this->orderBy($order)->where(['building_blocks_id' => $id]);
	}
}