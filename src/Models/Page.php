<?php

namespace Metrique\Building\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'meta' => '{}',
        'params' => '{}',
    ];

    protected $fillable = [
        'path',
        'title',
        'description',
        'image',
        'meta',
        'params',
        'published_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'params' => 'array',
        'published_at' => 'datetime'
    ];

    protected static function newFactory()
    {
        return \Metrique\Building\Database\Factories\PageFactory::new();
    }
}
