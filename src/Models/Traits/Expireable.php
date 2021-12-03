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
        return !is_null($this->expired_at) && now()->gte($this->expired_at);
    }
}
