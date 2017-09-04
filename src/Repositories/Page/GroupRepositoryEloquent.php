<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Repositories\Contracts\Page\GroupRepositoryInterface;
use Metrique\Building\Eloquent\Page\Group;

class GroupRepositoryEloquent implements GroupRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function destroy($id)
    {
        return Group::destroy($id);
    }
}
