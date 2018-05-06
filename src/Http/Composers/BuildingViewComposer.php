<?php

namespace Metrique\Building\Http\Composers;

use Collective\Html\FormBuilder;
use Illuminate\View\View;

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
    public function __construct(FormBuilder $form)
    {
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
        $view->with('form', $this->form);
    }
}
