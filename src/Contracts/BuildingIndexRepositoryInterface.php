<?php

namespace Metrique\Building\Contracts;

interface BuildingIndexRepositoryInterface extends BuildingRepositoryInterface
{	
	public function findWhere(array $where);
}