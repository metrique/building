<?php

namespace Metrique\Building\Http\Controllers\Component;

use Illuminate\Http\Request;
use Metrique\Building\Repositories\Contracts\ComponentRepositoryInterface as Component;
use Metrique\Building\Repositories\Contracts\Component\StructureRepositoryInterface as Structure;
use Metrique\Building\Repositories\Contracts\Component\TypeRepositoryInterface as Type;
use Metrique\Building\Http\Controllers\BuildingController;
use Metrique\Building\Http\Requests\StructureRequest;

class StructureController extends BuildingController
{
    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'metrique-building::component.structure.index',
        'create' => 'metrique-building::component.structure.create',
        'edit' => 'metrique-building::component.structure.edit',
    ];

    /**
     * List of routes used
     *
     * @var array
     */
    protected $routes = [
        'index' => 'component.structure.index',
        'create' => 'component.structure.create',
        'store' => 'component.structure.store',
        'edit' => 'component.structure.edit',
        'update' => 'component.structure.update',
        'destroy' => 'component.structure.destroy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id, Component $component, Structure $structure)
    {
        $this->mergeViewData([
            'data' => [
                'component' => $component->find($id),
                'structure' => $structure->byComponentId($id),
            ]
        ]);

        return $this->viewWithData($this->views['index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, Component $component, Type $type)
    {
        $this->mergeViewData([
            'data' => [
                'component' => $component->find($id),
                'types' => $type->formBuilderSelect(),
            ]
        ]);

        return $this->viewWithData($this->views['create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($id, StructureRequest $request, Structure $structure)
    {
        $structure->createWithRequest();

        return redirect()->route($this->routes['index'], $id);
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
    public function edit($id, $structureId, Component $component, Structure $structure, Type $type)
    {
        $this->mergeViewData([
            'data' => [
                'component' => $component->find($id),
                'structure' => $structure->find($structureId),
                'types' => $type->formBuilderSelect(),
            ]
        ]);

        return $this->viewWithData($this->views['edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(StructureRequest $request, $id, $structureId, Structure $structure)
    {
        $structure->updateWithRequest($structureId);

        return redirect()->route($this->routes['index'], $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $structureId, Structure $structure)
    {
        $structure->destroy($structureId);

        return redirect()->route($this->routes['index'], $id);
    }
}
