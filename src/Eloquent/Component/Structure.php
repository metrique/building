<?php

namespace Metrique\Building\Eloquent\Component;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Component;
use Metrique\Building\Eloquent\Component\Type;

class Structure extends Model
{
    protected $fillable = [
        'title',
        'order',
        'building_components_id',
        'building_component_types_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_component_structures';

    public function component()
    {
        return $this->belongsTo(Component::class, 'building_components_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'building_component_types_id');
    }
}
