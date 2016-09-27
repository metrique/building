<?php

namespace Metrique\Building\Http\Controllers\Block;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\BlockRepositoryInterface as BlockRepository;
use Metrique\Building\Contracts\Block\StructureRepositoryInterface as StructureRepository;
use Metrique\Building\Contracts\Block\TypeRepositoryInterface as TypeRepository;
use Metrique\Building\Http\Controllers\PageController;
use Metrique\Plonk\Http\Controller;

class StructureController extends Controller
{
    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'metrique-building::block.structure.index',
        'create' => 'metrique-building::block.structure.create',
        'edit' => 'metrique-building::block.structure.edit',
    ];

    /**
     * List of routes used
     *
     * @var array
     */
    protected $routes = [
        'index' => 'block.structure.index',
        'create' => 'block.structure.create',
        'store' => 'block.structure.store',
        'edit' => 'block.structure.edit',
        'update' => 'block.structure.update',
        'destroy' => 'block.structure.destroy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id, BlockRepository $blocks, StructureRepository $structure)
    {
        return view($this->views['index'])->with([
            'routes' => $this->routes,
            'data' => [
                'block' => $blocks->find($id),
                'structure' => $structure->byBlockId($id),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, BlockRepository $blocks, TypeRepository $type)
    {
        return view($this->views['create'])->with([
            'routes' => $this->routes,
            'data' => [
                'block' => $blocks->find($id),
                'types' => $type->formBuilderSelect(),
            ]
        ]);


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StructureRequest $request, BlockRepository $block)
    {
        $block->createWithRequest();

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
    public function edit($id, BlockRepository $block)
    {
        return view($this->views['edit'])->with([
            'routes' => $this->routes,
            'data' => $block->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(BlockRequest $request, $id, BlockRepository $block)
    {
        $block->updateWithRequest($id);

        return redirect()->route($this->routes['index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, BlockRepository $block)
    {
        try {
            $block->destroy($id);
        } catch (\Exception $e) {
            flash()->error(trans('error.general'));
            return redirect()->back();
        }

        flash()->success(trans('common.success'));
        return redirect()->route('cms.block.index');
    }
}
