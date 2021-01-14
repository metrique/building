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

    protected $fillable = [
        'path',
        'title',
        'description',
        'image',
        'meta',
        'params',
        'source_draft',
        'source_published',
        'published_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'params' => 'array',
        'source_draft' => 'array',
        'source_published' => 'array',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Metrique\Building\Database\Factories\PageFactory::new();
    }

    /**
     * Default Json
     */
    protected static function booted()
    {
        static::creating(function ($page) {
            if (is_null($page->meta)) {
                $page->meta = [];
            }

            if (is_null($page->params)) {
                $page->params = [];
            }

            if (is_null($page->source_draft)) {
                $page->source_draft = [];
            }

            if (is_null($page->source_published)) {
                $page->source_published = [];
            }
        });
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
        if (is_null($startsWith)) {
            $startsWith = [];
        }

        if (!is_array($startsWith)) {
            $startsWith = [
                $startsWith
            ];
        }

        if (empty($startsWith)) {
            return $query->where('id', '=', '0');
        }

        if (in_array('*', $startsWith)) {
            return $query;
        }

        return $query->where(function ($query) use ($startsWith) {
            collect($startsWith)->map(function ($string) {
                return '/' . trim($string, '/');
            })->each(function ($string) use ($query) {
                $query->orWhere('path', '=', $string);
                $query->orWhere('path', 'like', $string . '/%');
            });
        });
    }
}
