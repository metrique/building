<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'slug',
        'params',
        'meta',
        'published'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_pages';

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = $value == 1 ? true : false;
    }
}
