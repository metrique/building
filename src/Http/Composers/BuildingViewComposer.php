<?php

namespace Metrique\Building\Http\Composers;

use Collective\Html\FormBuilder;
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
     * The form builder
     */
    protected $form;

    /**
     * Create a new profile composer.
     *
     * @param  Building  $building
     * @return void
     */
    public function __construct(Building $building, FormBuilder $form)
    {
        $this->building = $building;
        $this->form = $form;
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
        $view->with('form', $this->form);
    }
}
