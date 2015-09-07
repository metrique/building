<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{

	protected $fillable = ['title', 'slug', 'single_item', 'params'];
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_blocks';

    public function structures()
    {
    	return $this->hasMany('Metrique\Building\Eloquent\BlockStructure', 'building_blocks_id');
    }
}