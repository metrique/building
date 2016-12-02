<?php

namespace Metrique\Building\Repositories\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface;

class SectionRepositoryEloquent extends EloquentRepositoryAbstract implements SectionRepositoryInterface
{
    protected $modelClassName = 'Metrique\Building\Eloquent\Page\Section';

    /**
     * {@inheritdocs}
     */
    public function byPageId($id, $order = ['order' => 'desc'])
    {
        return $this->orderBy($order)->with(['block'])->where(['building_pages_id' => $id])->get()->toArray();
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
