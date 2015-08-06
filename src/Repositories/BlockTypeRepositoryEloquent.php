<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\BlockTypeRepositoryInterface;

class BlockTypeRepositoryEloquent extends EloquentRepositoryAbstract implements BlockTypeRepositoryInterface
{
	public function __construct() {
	}
}