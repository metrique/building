<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Http\Request;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface as Page;
use Metrique\Building\Http\Controllers\BuildingController;
use Metrique\Building\Http\Requests\PageRequest;

class PageController extends BuildingController
{
    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'laravel-building::page.index',
        'create' => 'laravel-building::page.create',
        'edit' => 'laravel-building::page.edit',
    ];

    /**
     * List of routes used
     * @var array
     */
    protected $routes = [
        'index' => 'page.index',
        'create' => 'page.create',
        'store' => 'page.store',
        'edit' => 'page.edit',
        'update' => 'page.update',
        'destroy' => 'page.destroy',
        'section.index' => 'page.section.index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Page $page)
    {
        $this->mergeViewData([
            'data' => [
                'pages' => $page->all(),
            ]
        ]);

        return $this->viewWithData($this->views['index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->viewWithData($this->views['create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PageRequest $request, Page $page)
    {
        $page->createWithRequest();

        return redirect()->route($this->routes['index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Page $page)
    {
        $this->mergeViewData([
            'data' => $page->find($id),
        ]);

        return $this->viewWithData($this->views['edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PageRequest $request, $id, Page $page)
    {
        $page->updateWithRequest($id);

        return redirect()->route($this->routes['index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Page $page)
    {
        $page->destroy($id);

        return redirect()->route($this->routes['index']);
    }
}
