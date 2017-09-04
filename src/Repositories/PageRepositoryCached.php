<?php

namespace Metrique\Building\Repositories;

use Cache;
use Metrique\Building\Repositories\Traits\CacheBust;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\PageRepository;

class PageRepositoryCached extends PageRepository implements PageRepositoryInterface
{
    use CacheBust;
    
    public function publishedContentBySlug($slug)
    {
        $ttl = config('building.cache.ttl');
        $prefix = config('building.cache.prefix');
        
        return Cache::remember(sprintf('%s-%s', $prefix, $slug), $ttl, function () use ($slug) {
            return parent::publishedContentBySlug($slug);
        });
    }
    
    public function create(array $data)
    {
        if (array_key_exists('slug', $data)) {
            $this->cacheBust($data['slug']);
        }
        
        return parent::create($data);
    }
    
    public function update($id, array $data)
    {
        if (array_key_exists('slug', $data)) {
            $this->cacheBust($data['slug']);
        }
        
        return parent::update($id, $data);
    }
}
