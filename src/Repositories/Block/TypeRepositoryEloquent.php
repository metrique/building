<?php

namespace Metrique\Building\Repositories\Block;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Block\TypeRepositoryInterface;
use Metrique\Building\Eloquent\Block\Type;

class TypeRepositoryEloquent implements TypeRepositoryInterface
{
    public function formBuilderSelect()
    {
        return Type::orderBy('title', 'asc')->get()->keyBy('id')->map(function ($item) {
            return $item->title;
        });
    }
}
