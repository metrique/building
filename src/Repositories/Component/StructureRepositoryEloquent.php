<?php

namespace Metrique\Building\Repositories\Component;

use Metrique\Building\Eloquent\ComponentStructure;
use Metrique\Building\Repositories\Contracts\Component\StructureRepositoryInterface;

class StructureRepositoryEloquent implements StructureRepositoryInterface
{
    protected $modelClassName = ComponentStructure::class;

    public function byComponentId($id)
    {
        return Structure::orderBy('order', 'desc')->where('components_id', $id)->get();
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
            'components_id',
            'component_types_id',
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
            'components_id',
            'component_types_id',
        ]));
    }
}
