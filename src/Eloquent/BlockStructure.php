<?php

namespace Metrique\Building\Eloquent;

use Illuminate\Database\Eloquent\Model;

class BlockStructure extends Model
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
    	return $this->belongsTo('Metrique\Building\Eloquent\BlockType', 'building_block_types_id');
    }
}
