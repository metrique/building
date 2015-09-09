<?php

namespace Metrique\Building\Contracts\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface StructureRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function byBlockId($id, $order = ['order' => 'DESC']);
}