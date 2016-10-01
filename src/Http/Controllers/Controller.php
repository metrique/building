<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Data for views.
     * @var array
     */
    protected $viewData = [];

    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [];

    /**
     * List of routes used
     * @var array
     */
    protected $routes = [];

    public function __construct()
    {
        $this->viewData = [
            'routes' => $this->routes,
            'views' => $this->views,
            'data' => [],
        ];
    }

    /**
     * Merges default view data with new view data.
     * @param  array $data
     * @return array
     */
    protected function mergeViewData($data)
    {
        return $this->viewData = array_merge($this->viewData, $data);
    }
}
