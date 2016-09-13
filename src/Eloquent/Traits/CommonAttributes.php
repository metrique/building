<?php

namespace Metrique\Building\Eloquent\Traits;

use Metrique\Building\Building;

trait CommonAttributes
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = app(Building::class)->slugify($value);
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = $value == 1 ? true : false;
    }
}
