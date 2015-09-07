<?php

namespace Metrique\Building\Contracts\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface TypeRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function formSelect();
}