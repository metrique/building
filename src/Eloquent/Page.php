<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Contracts\BuildingInterface;

class Page extends Model
{
    use Traits\CommonAttributes;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'id',
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
    protected $table = 'pages';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
