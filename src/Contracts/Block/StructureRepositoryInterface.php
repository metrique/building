<?php

namespace Metrique\Building\Contracts\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface StructureRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function withBlockId($id);
}