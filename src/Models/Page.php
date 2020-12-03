<?php

namespace Metrique\Building\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Metrique\Building\Database\Factories\PageFactory::new();
    }
}
