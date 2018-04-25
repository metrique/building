<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Repositories\Contracts\BuildingInterface;

class Page extends Model
{
    use Traits\CommonAttributes;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'slug',
        'params',
        'meta',
        'published'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
