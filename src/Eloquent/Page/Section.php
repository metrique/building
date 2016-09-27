<?php

namespace Metrique\Building\Eloquent\Page;

use Illuminate\Database\Eloquent\Model;
use Metrique\Building\Eloquent\Page;
use Metrique\Building\Eloquent\Block;
use Metrique\Building\Eloquent\Traits\CommonAttributes;

class Section extends Model
{
    use CommonAttributes;

    protected $fillable = [
        'title',
        'slug',
        'order',
        'params',
        'building_pages_id',
        'building_blocks_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'building_page_sections';

    public function page()
    {
        return $this->belongsTo(Page::class, 'building_pages_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'building_blocks_id');
    }
}
