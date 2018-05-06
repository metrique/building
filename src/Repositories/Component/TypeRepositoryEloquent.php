<?php

namespace Metrique\Building\Repositories\Component;

use Metrique\Building\Eloquent\ComponentType;
use Metrique\Building\Repositories\Contracts\Component\TypeRepositoryInterface;

class TypeRepositoryEloquent implements TypeRepositoryInterface
{
    public function formBuilderSelect()
    {
        return ComponentType::orderBy('title', 'asc')->get()->keyBy('id')->map(function ($item) {
            return $item->title;
        });
    }
}
