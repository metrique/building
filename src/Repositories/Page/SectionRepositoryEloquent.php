<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface;
use Metrique\Building\Eloquent\Page\Section;

class SectionRepositoryEloquent implements SectionRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Section::orderBy('order', 'desc');
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Section::find($id);
    }

    /**
    * {@inheritdocs}
    */
    public function findWithStructure($id)
    {
        return Section::with(['page', 'component.structure.type', 'component.structure' => function ($query) {
            $query->orderBy('order', 'desc');
        }])->where('id', $id)->first();
    }

    /**
     * {@inheritdocs}
     */
    public function byPageId($id, $order = ['order' => 'desc'])
    {
        return Section::orderBy('order', 'desc')->where([
            'building_pages_id' => $id
        ])->get();
    }


    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $data['slug'] = $data['slug'] ?: $data['title'];
        $data['order'] = $data['order'] ?: 0;

        return Section::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function createWithRequest()
    {
        return $this->create(request()->only([
            'title',
            'slug',
            'order',
            'params',
            'building_pages_id',
            'building_components_id',
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($id)
    {
        return Section::destroy($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $data['slug'] = $data['slug'] ?: $data['title'];
        $data['order'] = $data['order'] ?: 0;

        return Section::find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithRequest($id)
    {
        return $this->update($id, request()->only([
            'title',
            'slug',
            'order',
            'params',
            'building_pages_id',
            'building_components_id',
        ]));
    }
}
