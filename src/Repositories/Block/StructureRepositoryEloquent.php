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

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Structure::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $data['order'] = $data['order'] ?: 0;

        return Structure::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function createWithRequest()
    {
        return $this->create(request()->only([
            'title',
            'order',
            'building_blocks_id',
            'building_block_types_id',
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($id)
    {
        return Structure::destroy($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $data['order'] = $data['order'] ?: 0;

        return Structure::find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithRequest($id)
    {
        return $this->update($id, request()->only([
            'title',
            'order',
            'building_blocks_id',
            'building_block_types_id',
        ]));
    }
}
