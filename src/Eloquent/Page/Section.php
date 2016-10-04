<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Page;
use Metrique\Building\Eloquent\Component;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class Section extends Model
{
    use CommonAttributes;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'order',
        'params',
        'pages_id',
        'components_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_sections';

    public function page()
    {
        return $this->belongsTo(Page::class, 'pages_id');
    }

    public function component()
    {
        return $this->belongsTo(Component::class, 'components_id');
    }
}
