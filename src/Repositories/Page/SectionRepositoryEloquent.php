<?php

namespace Metrique\Building\Repositories\Page;

use DB;
use Metrique\Building\Eloquent\PageSection;
use Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface;

class SectionRepositoryEloquent implements SectionRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return PageSection::orderBy('order', 'desc');
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return PageSection::find($id);
    }

    /**
    * {@inheritdocs}
    */
    public function findWithStructure($id)
    {
        return PageSection::with([
            'page',
            'component.structure.type',
            'component.structure' => function ($query) {
                $query->orderBy('order', 'desc');
            }
        ])->where('id', $id)->first();
    }

    /**
     * {@inheritdocs}
     */
    public function byPageId($id, $order = ['order' => 'desc'])
    {
        return PageSection::orderBy('order', 'desc')->where([
            'pages_id' => $id
        ])->get();
    }


    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $data['order'] = $data['order'] ?: 0;
        
        DB::transaction(function () use ($data) {
            $section = PageSection::create($data);
            $section->slug = md5($section->id);
            return $section->save();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function createWithRequest()
    {
        return $this->create(request()->only([
            'title',
            'order',
            'params',
            'pages_id',
            'components_id',
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($id)
    {
        return PageSection::destroy($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $data['order'] = $data['order'] ?: 0;

        return PageSection::find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithRequest($id)
    {
        return $this->update($id, request()->only([
            'title',
            'order',
            'params',
            'pages_id',
            'components_id',
        ]));
    }
}
