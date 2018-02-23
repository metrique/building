<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Page\Group;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class PageContent extends Model
{
    use CommonAttributes;

    protected $fillable = [
        'id',
        'content',
        'pages_id',
        'page_sections_id',
        'page_groups_id',
        'component_structures_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'page_groups_id');
    }
}
