<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ComponentType extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'params'
    ];
}
