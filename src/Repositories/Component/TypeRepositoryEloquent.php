<?php

namespace Metrique\Building\Repositories\Component;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Repositories\Contracts\Component\TypeRepositoryInterface;
use Metrique\Building\Eloquent\Component\Type;

class TypeRepositoryEloquent implements TypeRepositoryInterface
{
    public function formBuilderSelect()
    {
        return Type::orderBy('title', 'asc')->get()->keyBy('id')->map(function ($item) {
            return $item->title;
        });
    }
}
