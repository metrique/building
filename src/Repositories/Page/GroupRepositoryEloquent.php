<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Contracts\Page\GroupRepositoryInterface;

class GroupRepositoryEloquent implements GroupRepositoryInterface
{
    protected $modelClassName = 'Metrique\Building\Eloquent\Page\Group';
}
