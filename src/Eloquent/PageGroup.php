<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class PageGroup extends Model
{
    use CommonAttributes;

    protected $fillable = [
        'id',
        'order',
        'params',
        'published',
        'page_contents_id',
    ];
}
