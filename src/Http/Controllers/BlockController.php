<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\BlockRepositoryInterface as BlockRepository;
use Metrique\Building\Http\Controllers\PageController;
use Metrique\Building\Http\Requests\BlockRequest;
use Metrique\Plonk\Http\Controller;

class BlockController extends Controller
{
    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'metrique-building::block.index',
        'create' => 'metrique-building::block.create',
        'edit' => 'metrique-building::block.edit',
    ];

    /**
     * List of routes used
     * @var [type]
     */
    protected $routes = [
        'index' => 'block.index',
        'create' => 'block.create',
        'store' => 'block.store',
        'edit' => 'block.edit',
        'update' => 'block.update',
        'destroy' => 'block.destroy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(BlockRepository $blocks, Request $request)
    {
        return view($this->views['index'])->with([
            'data' => $blocks->all(),
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
    public function store(BlockRequest $request, BlockRepository $block)
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
