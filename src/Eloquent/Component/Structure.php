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
        'components_id',
        'component_types_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'component_structures';

    public function component()
    {
        return $this->belongsTo(Component::class, 'components_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'component_types_id');
    }
}
