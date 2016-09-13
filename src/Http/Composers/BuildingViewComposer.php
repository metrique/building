<?php

namespace Metrique\Building\Http\Composers;

use Illuminate\View\View;
use Metrique\Building\Building;

class BuildingViewComposer
{
    /**
     * The building repository.
     *
     * @var Building
     */
    protected $building;

    /**
     * Create a new profile composer.
     *
     * @param  Building  $building
     * @return void
     */
    public function __construct(Building $building)
    {
        $this->building = $building;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('building', $this->building);
    }
}
