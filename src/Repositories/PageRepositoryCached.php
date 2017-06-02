<?php

namespace Metrique\Building\Repositories;

use Cache;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\PageRepository;

class PageRepositoryCached extends PageRepository implements PageRepositoryInterface
{
    public function publishedContentBySlug($slug)
    {
        $ttl = config('building.cache.ttl');
        $prefix = config('building.cache.prefix');
        
        return Cache::remember(sprintf('%s-%s', $prefix, $slug), $ttl, function () use ($slug) {
            return parent::publishedContentBySlug($slug);
        });
    }
}
