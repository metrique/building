<?php

namespace Metrique\Building\Eloquent\Traits;

use Metrique\Building\Support\Slug;

trait CommonAttributes
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Slug::slugify($value);
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = $value == 1 ? true : false;
    }

    public function setSingleItemAttribute($value)
    {
        $this->attributes['single_item'] = $value == 1 ? true : false;
    }
}
