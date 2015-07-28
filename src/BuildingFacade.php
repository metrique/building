<?php

namespace Metrique\Building;

use Illuminate\Support\Facades\Facade;

class BuildingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return '\Metrique\Building\Building';
    }
}