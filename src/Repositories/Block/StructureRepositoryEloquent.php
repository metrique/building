<?php

namespace Metrique\Building\Repositories\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Block\StructureRepositoryInterface;

class StructureRepositoryEloquent extends EloquentRepositoryAbstract implements StructureRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Block\Structure';

	public function withBlockId($id, $order = ['order' => 'DESC'])
	{
		return $this->orderBy($order)->where(['building_blocks_id' => $id])->get();
	}
}