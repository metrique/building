<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'order',
        'params',
        'published'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_page_groups';
}
