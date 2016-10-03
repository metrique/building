<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class Group extends Model
{
    use CommonAttributes;

    protected $fillable = [
        'order',
        'params',
        'published',
        'page_contents_id',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_groups';
}
