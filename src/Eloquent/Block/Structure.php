<?php

namespace Metrique\Building\Eloquent\Block;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Block;
use Metrique\Building\Eloquent\Block\Type;

class Structure extends Model
{

    protected $fillable = [
        'title',
        'order',
        'building_blocks_id',
        'building_block_types_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_block_structures';

    public function block()
    {
        return $this->belongsTo(Block::class, 'building_blocks_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'building_block_types_id');
    }
}
