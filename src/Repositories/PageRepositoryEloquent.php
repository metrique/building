<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\PageRepositoryInterface;


class PageRepositoryEloquent extends EloquentRepositoryAbstract implements PageRepositoryInterface
{
    protected $modelClassName = 'Metrique\Building\Eloquent\Page';

    /**
     * The last collected page.
     * @var Illuminate\Database\Eloquent\Builder
     */
    protected $page;

    /**
     * Collection of meta tags from last retrieved page.
     * @var array
     */
    protected $meta = [];

    /**
     * {@inheritdoc}
     */
    public function bySlug($slug)
    {
        $this->page = $this->model->where(['slug' => $slug, 'published' => 1]);

        if($this->page->count() != 1)
        {
            Throw new \Exception("Page with slug `$slug` doesn't exist.");
        }

        // Store page
        $this->page = $this->page->first();

        // Store meta...
        $this->meta = json_decode($this->page->meta, true);

        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function contentsBySlug($slug)
    {
        $content = $this->app->make('Metrique\Building\Contracts\Page\ContentRepositoryInterface');
        $section = $this->app->make('Metrique\Building\Contracts\Page\SectionRepositoryInterface');

        $contents = [];

        foreach($section->byPageId($this->bySlug($slug)->id) as $key => $value)
        {
            $value['params'] = json_decode($value['params'], true);
            
            // Widget rendering.
            if($value['block']['slug'] == 'widget')
            {
                $value['_contents'] = array_pluck($content->bySectionId($value['id']), 'content');
                $value['_contents'] = $this->app->make($value['_contents'][0])->render($value['_contents'][1], $this->app);
            } else {
                $value['_contents'] = $content->groupBySectionId($value['id']);    
            }

            // Widget rendering should go here?
            $contents[] = $value;
        }

        return $contents;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta($key)
    {
        if(!array_key_exists($key, $this->meta))
        {
            return '';
        }

        return $this->meta[$key];
    }
}