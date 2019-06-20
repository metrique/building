<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Eloquent\Page;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface as ContentRepository;
use Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface as SectionRepository;

class PageRepository implements PageRepositoryInterface
{
    private $pagination = 15;

    public function __construct(ContentRepository $content, SectionRepository $section)
    {
        $this->content = $content;
        $this->section = $section;
    }

    private function index()
    {
        if (request()->has('search')) {
            $search = sprintf(
                '%%%s%%',
                request('search')
            );

            return Page::where('slug', 'like', str_slug($search))
                ->orWhere('title', 'like', $search);
        }

        return Page::orderBy('title', 'asc');
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->index()->get([
            'id',
            'title',
            'description',
            'slug',
            'published'
        ]);
    }

    public function paginate()
    {
        return $this->index()->paginate($this->pagination, [
            'id',
            'title',
            'description',
            'slug',
            'published'
        ]);
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
        return Page::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function createWithRequest()
    {
        return $this->create(request()->only([
            'title',
            'description',
            'image',
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
        return Page::find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithRequest($id)
    {
        return $this->update($id, request()->only([
            'title',
            'description',
            'image',
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
        return Page::where([
            'slug' => $slug,
            'published' => 1
        ])->first();
    }

    public function publishedContentBySlug($slug)
    {
        return $this->section->byPageId(
            $this->bySlug($slug)->id
        )->map(function ($item, $key) {
            if ($item->component->slug == 'widget') {
                // Widget rendering goes here...
            }

            $item->content = $this->content->groupPublishedBySectionId($item->id);

            return $item;
        });
    }
    /**
     * {@inheritdoc}
     */
    public function contentBySlug($slug)
    {
        return $this->section->byPageId(
            $this->bySlug($slug)->id
        )->map(function ($item, $key) {
            if ($item->component->slug == 'widget') {
                // Widget rendering goes here...
            }

            $item->content = $this->content->groupBySectionId($item->id);

            return $item;
        });
    }

    public function setPagination($pagination)
    {
        return $this->pagination = $pagination;
    }
}
