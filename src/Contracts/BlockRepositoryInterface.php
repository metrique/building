<?php

namespace Metrique\Building\Contracts;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface BlockRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function formSelect();
}