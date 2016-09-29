<?php

namespace Metrique\Building\Http\Controllers\Component;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\ComponentRepositoryInterface as ComponentRepository;
use Metrique\Building\Contracts\Component\StructureRepositoryInterface as StructureRepository;
use Metrique\Building\Contracts\Component\TypeRepositoryInterface as TypeRepository;
use Metrique\Building\Http\Controllers\PageController;
use Metrique\Building\Http\Requests\StructureRequest;
use Metrique\Plonk\Http\Controller;

class StructureController extends Controller
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
    public function index($id, ComponentRepository $components, StructureRepository $structure)
    {
        return view($this->views['index'])->with([
            'routes' => $this->routes,
            'data' => [
                'component' => $components->find($id),
                'structure' => $structure->byComponentId($id),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, ComponentRepository $components, TypeRepository $type)
    {
        return view($this->views['create'])->with([
            'routes' => $this->routes,
            'data' => [
                'component' => $components->find($id),
                'types' => $type->formBuilderSelect(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($id, StructureRequest $request, StructureRepository $structure)
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
    public function edit($id, $structureId, ComponentRepository $component, StructureRepository $structure, TypeRepository $type)
    {
        return view($this->views['edit'])->with([
            'routes' => $this->routes,
            'data' => [
                'component' => $component->find($id),
                'structure' => $structure->find($structureId),
                'types' => $type->formBuilderSelect(),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(StructureRequest $request, $id, $structureId, StructureRepository $structure)
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
    public function destroy($id, $structureId, StructureRepository $structure)
    {
        $structure->destroy($structureId);

        return redirect()->route($this->routes['index'], $id);
    }
}
