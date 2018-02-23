<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Component\Structure;

class Component extends Model
{
    use Traits\CommonAttributes;

    protected $casts = [
        'single_item' => 'boolean',
    ];

    protected $fillable = [
        'id',
        'title',
        'slug',
        'single_item',
        'params'
    ];

    public function structure()
    {
        return $this->hasMany(Structure::class, 'components_id');
    }
}
