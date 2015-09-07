<?php

namespace Metrique\Building\Eloquent\Block;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{

	protected $fillable = ['title', 'order', 'building_blocks_id', 'building_block_types_id'];
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_block_structures';

    public function block()
    {
    	return $this->belongsTo('Metrique\Building\Eloquent\Block', 'building_blocks_id');
    }

    public function type()
    {
    	return $this->belongsTo('Metrique\Building\Eloquent\Block\Type', 'building_block_types_id');
    }
}
