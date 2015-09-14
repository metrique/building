<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\GroupRepositoryInterface;

class GroupRepositoryEloquent extends EloquentRepositoryAbstract implements GroupRepositoryInterface
{
	protected $modelClassName = 'Metrique\Building\Eloquent\Page\Group';
}