<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Http\Request;
use Metrique\Building\Repositories\Contracts\ComponentRepositoryInterface as Component;
use Metrique\Building\Http\Controllers\BuildingController;
use Metrique\Building\Http\Requests\ComponentRequest;

class ComponentController extends BuildingController
{
    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'metrique-building::component.index',
        'create' => 'metrique-building::component.create',
        'edit' => 'metrique-building::component.edit',
    ];

    /**
     * List of routes used
     * @var array
     */
    protected $routes = [
        'index' => 'component.index',
        'create' => 'component.create',
        'store' => 'component.store',
        'edit' => 'component.edit',
        'update' => 'component.update',
        'destroy' => 'component.destroy',
        'structure.index' => 'component.structure.index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Component $component)
    {
        $this->mergeViewData([
            'data' => $component->all(),
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
    public function store(ComponentRequest $request, Component $component)
    {
        $component->createWithRequest();

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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Component $component)
    {
        $this->mergeViewData([
            'data' => $component->find($id),
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
    public function update(ComponentRequest $request, $id, Component $component)
    {
        $component->updateWithRequest($id);

        return redirect()->route($this->routes['index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Component $component)
    {
        $component->destroy($id);

        return redirect()->route($this->routes['destroy']);
    }
}
