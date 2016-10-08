<?php

namespace Metrique\Building\Repositories;

use Stringy\Stringy;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface as ContentRepository;
use Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface as SectionRepository;
use Metrique\Building\Eloquent\Page;

class PageRepositoryEloquent implements PageRepositoryInterface
{
    public function __construct(SectionRepository $section)
    {
        // $this->content = $content;
        $this->section = $section;
    }

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
        return Page::where(['slug' => $slug, 'published' => 1])->first();
    }

    public function publishedContentBySlug($slug)
    {
        return $this->section->byPageId($this->bySlug($slug)->id)->map(function ($item, $key) {
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
        return $this->section->byPageId($this->bySlug($slug)->id)->map(function ($item, $key) {
            if ($item->component->slug == 'widget') {
                // Widget rendering goes here...
            }

            $item->content = $this->content->groupBySectionId($item->id);

            return $item;
        });
        // $content = $this->app->make(ContentRepositoryInterface::class);
        // $section = $this->app->make(SectionRepositoryInterface::class);

        // dd($section->byPageId($this->bySlug($slug)->id));
        /*
        $content = $this->app->make('Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface');
        $section = $this->app->make('Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface');

        $contents = [];

        foreach ($section->byPageId($this->bySlug($slug)->id) as $key => $value) {
            $value['params'] = json_decode($value['params'], true);

            // Widget rendering.
            if ($value['component']['slug'] == 'widget') {
                $value['_contents'] = array_pluck($content->bySectionId($value['id']), 'content');
                $value['_contents'] = $this->app->make($value['_contents'][0])->render($value['_contents'][1], $this->app);
            } else {
                $value['_contents'] = $content->groupBySectionId($value['id']);
            }

            $contents[] = $value;
        }

        return $contents;
        */
    }

    /**
     * {@inheritdoc}
     */
    public function slugify($string, $delimiter = '-', $directorySeperator = '_')
    {
        // Allowed character list
        $allowed = "/[^a-zA-Z\d\s-_\/" . preg_quote($delimiter) . "]/u";

        // Convert to closest ASCII
        $string = Stringy::create($string)->toAscii();

        // Remove non allowed characters
        $string = preg_replace($allowed, '', $string);

        // Lowercase, delimit and trim!
        $string = Stringy::create($string)
            ->toLowerCase()
            ->delimit($delimiter)
            ->removeLeft($delimiter)
            ->removeRight($delimiter);

        // Convert path seperators to underscores.
        $string = str_replace('/', '_', $string);

        return $string;
    }

    /**
     * {@inheritdoc}
     */
    public function unslugify($string, $directorySeperator = '_')
    {
        return str_replace($directorySeperator, '/', $string);
    }
}
