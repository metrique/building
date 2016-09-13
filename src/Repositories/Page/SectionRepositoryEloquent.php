<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface;
use Metrique\Building\Eloquent\Page\Section;

class SectionRepositoryEloquent implements SectionRepositoryInterface
{
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
     * {@inheritdocs}
     */
    public function findWithAll($id)
    {
        $this->make();

        return $this->model->with(['page', 'block.structure' => function ($query) {
            $query->orderBy('order', 'desc');
        }, 'block.structure.type'])->where('id', $id)->first()->toArray();
    }
}
