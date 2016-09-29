<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Page\Group;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class Content extends Model
{
    use CommonAttributes;

    protected $fillable = [
        'params',
        'content',
        'building_pages_id',
        'building_page_sections_id',
        'building_page_groups_id',
        'building_component_structures_id',
        'building_component_types_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_page_contents';

    public function group()
    {
        return $this->belongsTo(Group::class, 'building_page_groups_id');
    }
}
