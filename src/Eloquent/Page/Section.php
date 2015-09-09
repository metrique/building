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

    public function page()
    {
        return $this->belongsTo('Metrique\Building\Eloquent\Page', 'building_pages_id');
    }

    public function block()
    {
    	return $this->belongsTo('Metrique\Building\Eloquent\Block', 'building_blocks_id');
    }
}
