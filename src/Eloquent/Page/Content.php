<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

	protected $fillable = ['params', 'body', 'building_pages_id', 'building_page_sections_id', 'building_page_groups_id', 'building_block_types_id'];
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_page_contents';
}
