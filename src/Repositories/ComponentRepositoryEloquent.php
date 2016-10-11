<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Repositories\Contracts\ComponentRepositoryInterface;
use Metrique\Building\Eloquent\Component;

class ComponentRepositoryEloquent implements ComponentRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Component::orderBy('title', 'asc')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Component::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return Component::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function createWithRequest()
    {
        return $this->create(request()->only([
            'title',
            'slug',
            'params',
            'single_item',
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($id)
    {
        return Component::destroy($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        return $this->find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithRequest($id)
    {
        return $this->update($id, request()->only([
            'title',
            'slug',
            'params',
            'single_item',
        ]));
    }

    public function formBuilderSelect()
    {
        return Component::orderBy('title', 'asc')->get()->keyBy('id')->map(function ($item) {
            return $item->title;
        });
    }
}
