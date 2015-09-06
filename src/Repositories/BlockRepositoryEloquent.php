<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\BlockRepositoryInterface;

class BlockRepositoryEloquent extends EloquentRepositoryAbstract implements BlockRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Block';
}