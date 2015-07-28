<?php

namespace Metrique\Building;

use Metrique\Building\Abstracts\BuildingAbstractRepository;
use Metrique\Building\Contracts\BuildingIndexRepositoryInterface;

class EloquentBuildingIndexRepository extends BuildingAbstractRepository implements BuildingIndexRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\BuildingIndex';

	public function findWhere(array $where)
	{
		$defaults = [
			'disabled' => false,
			'navigation' => false,
			'published' => false,
		];

		$where = array_intersect_key($where, $defaults);
		$where = array_merge($defaults, $where);

		$collection = $this->model->all();
		foreach ($where as $key => $value) {
			$collection = $collection->where('published', '=', '1');
		}

		return $collection->toArray();
	}
}