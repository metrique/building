<?php

namespace Metrique\Building\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Metrique\Building\Models\Traits\Publishable;

class Page extends Model
{
    use Publishable;
    use HasFactory;
    use SoftDeletes;

    protected $appends = [
        'is_published'
    ];
    
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
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Metrique\Building\Database\Factories\PageFactory::new();
    }
    
    /**
     * Shows pages where path starts with given strings
     *
     * @param  mixed $query
     * @param  mixed $startsWith
     * @return void
     */
    public function scopePathStartsWith($query, $startsWith)
    {
        if (is_string($startsWith)) {
            $startsWith = [
                $startsWith
            ];
        }

        if (in_array('*', $startsWith)) {
            return $query;
        }

        return $query->where(function ($query) use ($startsWith) {
            collect($startsWith)->map(function ($string) {
                $string = ltrim($string, '/');
                return sprintf('/%s%%', $string);
            })->each(function ($string) use ($query) {
                $query->orWhere('path', 'like', $string);
            });
        });
    }
}
