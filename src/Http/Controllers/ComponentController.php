<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\ComponentRepositoryInterface as ComponentRepository;
use Metrique\Building\Http\Controllers\PageController;
use Metrique\Building\Http\Requests\ComponentRequest;
use Metrique\Plonk\Http\Controller;

class BlockController extends Controller
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
    public function index(ComponentRepository $components)
    {
        return view($this->views['index'])->with([
            'data' => $components->all(),
            'routes' => $this->routes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view($this->views['create'])->with([
            'routes' => $this->routes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ComponentRequest $request, ComponentRepository $component)
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
    public function edit($id, ComponentRepository $component)
    {
        return view($this->views['edit'])->with([
            'routes' => $this->routes,
            'data' => $component->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ComponentRequest $request, $id, ComponentRepository $component)
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
    public function destroy($id, ComponentRepository $component)
    {
        $component->destroy($id);

        return redirect()->route($this->routes['destroy']);
    }
}
