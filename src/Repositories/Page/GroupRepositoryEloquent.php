<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Eloquent\PageGroup;
use Metrique\Building\Repositories\Contracts\Page\GroupRepositoryInterface;

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
