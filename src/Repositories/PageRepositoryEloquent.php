<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Contracts\PageRepositoryInterface;
use Metrique\Building\Eloquent\Page;

class PageRepositoryEloquent implements PageRepositoryInterface
{
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
    public function all()
    {
        return Page::orderBy('title', 'asc')->get(['id', 'title', 'slug', 'published']);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Page::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $data['slug'] = $data['slug'] ?: $data['title'];

        return Page::create($data);
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
            'meta',
            'published'
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
        $data['slug'] = $data['slug'] ?: $data['title'];
        
        return Page::find($id)->update($data);
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
            'meta',
            'published'
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function bySlug($slug)
    {
        $this->page = Page::where(['slug' => $slug, 'published' => 1]);

        if ($this->page->count() != 1) {
            throw new \Exception("Page with slug `$slug` doesn't exist.");
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
    public function contentBySlug($slug)
    {
        $content = $this->app->make('Metrique\Building\Contracts\Page\ContentRepositoryInterface');
        $section = $this->app->make('Metrique\Building\Contracts\Page\SectionRepositoryInterface');

        $contents = [];

        foreach ($section->byPageId($this->bySlug($slug)->id) as $key => $value) {
            $value['params'] = json_decode($value['params'], true);

            // Widget rendering.
            if ($value['block']['slug'] == 'widget') {
                $value['_contents'] = array_pluck($content->bySectionId($value['id']), 'content');
                $value['_contents'] = $this->app->make($value['_contents'][0])->render($value['_contents'][1], $this->app);
            } else {
                $value['_contents'] = $content->groupBySectionId($value['id']);
            }

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
        if (!array_key_exists($key, $this->meta)) {
            return '';
        }

        return $this->meta[$key];
    }
}
