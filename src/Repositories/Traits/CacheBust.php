<?php

namespace Metrique\Building\Repositories\Traits;

trait CacheBust
{
    public function cacheBust($slugOrId)
    {
        if (is_int($slugOrId)) {
            $slugOrId = \Metrique\Building\Eloquent\Page::findOrFail($slugOrId)->slug;
        }
        
        $prefix = config('building.cache.prefix');
        return cache()->forget(sprintf('%s-%s', $prefix, $slugOrId));
    }
}
