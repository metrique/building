<?php

namespace Metrique\Building\Eloquent\Component;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'params'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_block_types';

    // public function structure()
    // {
        // return $this->belongsTo('Metrique\Building\Eloquent\ComponentStructure', 'building_block_structure');
    // }
}
