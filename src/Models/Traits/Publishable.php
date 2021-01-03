<?php

namespace Metrique\Building\Models\Traits;

trait Publishable
{
    public function scopePublished($query)
    {
        return $query
            ->where('published_at', '<=', now());
    }

    public function scopeUnpublished($query)
    {
        return $query
            ->where('published_at', '>', now())
            ->orWhere('published_at', '=', 'null');
    }

    public function getIsPublishedAttribute()
    {
        return now()->gt($this->published_at);
    }
}
