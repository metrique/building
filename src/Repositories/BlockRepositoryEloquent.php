<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\BlockRepositoryInterface;
use Metrique\Building\Eloquent\Block;

class BlockRepositoryEloquent implements BlockRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Block::orderBy('title', 'asc')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Block::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $data['slug'] = $data['slug'] ?: $data['title'];

        return Block::create($data);
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
        return Page::destroy($id);
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
        $form = [];

        $form = Block::orderBy('title', 'asc')->get()->map(function ($key, $item) {
        });

        // foreach ($this->all(['id', 'title'], ['title' => 'ASC']) as $key => $value) {
            // $form[$value->id] = $value->title;
        // }

        return $form;
    }
}
