<?php

namespace Metrique\Building;

use Illuminate\Container\Container;
use Metrique\Building\Abstracts\BuildingAbstractRepository;
use Metrique\Building\Contracts\BuildingIndexRepositoryInterface;

class CachingBuildingIndexRepository extends BuildingAbstractRepository implements BuildingIndexRepositoryInterface
{
	protected $repository;
	protected $modelClassName = '';

	public function __construct(Container $app, BuildingIndexRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function findWhere(array $where)
	{
		return $this->repository->findWhere($where);
	}
}