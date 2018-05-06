<?php

namespace Metrique\Building\Http\Controllers\Component;

use Illuminate\Http\Request;
use Metrique\Building\Repositories\Contracts\Component\TypeRepositoryInterface as Type;
use Metrique\Building\Http\Controllers\BuildingController;

class TypeController extends BuildingController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Type $type)
    {
        $data = [
            'types' => $type->all(['title', 'slug', 'params', 'input_type'], ['slug' => 'ASC'])
        ];

        return view('cms.building.component.type.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
        ];

        return view('cms.building.component.type.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ComponentTypeRequest $request, Type $type)
    {
        $type->create([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'params' => $request->input('params'),
            ]);
        return redirect()->route('cms.type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Type $type)
    {
        $type = $type->find($id);

        $data = [
            'type' => $type
        ];

        return view('cms.building.component.type.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ComponentTypeRequest $request, $id, Type $type)
    {
        //
            $type->update($id, [
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'params' => $request->input('params'),
            ]);
        return redirect()->route('cms.type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Type $type)
    {
        $type->destroy($id);

        return redirect()->route('cms.type.index');
    }
}
