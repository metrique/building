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
        'title',
        'slug',
        'single_item',
        'params'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_components';

    public function structure()
    {
        return $this->hasMany(Structure::class, 'building_components_id');
    }
}
