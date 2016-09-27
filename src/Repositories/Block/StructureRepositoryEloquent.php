<?php

namespace Metrique\Building\Repositories\Block;

use Metrique\Building\Contracts\Block\StructureRepositoryInterface;
use Metrique\Building\Eloquent\Block\Structure;

class StructureRepositoryEloquent implements StructureRepositoryInterface
{
    protected $modelClassName = 'Metrique\Building\Eloquent\Block\Structure';

    public function byBlockId($id)
    {
        return Structure::orderBy('order', 'desc')->where('building_blocks_id', $id)->get();
    }
}
