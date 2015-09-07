<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BlockType extends Model
{

	protected $fillable = ['title', 'slug', 'params'];
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_block_types';

    // public function structure()
    // {
    	// return $this->belongsTo('Metrique\Building\Eloquent\BlockStructure', 'building_block_structure');
    // }
}
