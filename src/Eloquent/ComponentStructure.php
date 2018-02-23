<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Component;
use Metrique\Building\Eloquent\Component\Type;

class ComponentStructure extends Model
{
    protected $fillable = [
        'id',
        'title',
        'order',
        'components_id',
        'component_types_id'
    ];

    public function component()
    {
        return $this->belongsTo(Component::class, 'components_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'component_types_id');
    }
}
