<?php

namespace Metrique\Building\Repositories\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Block\StructureRepositoryInterface;

class StructureRepositoryEloquent extends EloquentRepositoryAbstract implements StructureRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\BlockStructure';

	public function withBlockId($id, $order = ['order' => 'DESC'])
	{
		if(count($order) > 0)
        {
            foreach($order as $key => $value)
            {
                $this->model = $this->model->orderBy($key, $value);
            }
        }

		return $this->model->where(['building_blocks_id' => $id])->get();
	}	
}