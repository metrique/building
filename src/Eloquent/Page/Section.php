<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

	protected $fillable = ['title', 'slug', 'order', 'params', 'building_pages_id', 'building_blocks_id'];
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_page_sections';
}
