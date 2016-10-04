<?php

namespace Metrique\Building\Eloquent\Component;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'params'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'component_types';
}
