<?php

namespace Metrique\Building\Models\Traits;

trait Expireable
{
    public function scopeExpired($query)
    {
        return $query
            ->where('expired_at', '>=', now());
    }

    public function scopeUnexpired($query)
    {
        return $query
            ->where('expired_at', '<', now())
            ->orWhere('expired_at', '=', 'null');
    }

    public function getIsExpiredAttribute()
    {
        return now()->lt($this->expired_at);
    }
}
