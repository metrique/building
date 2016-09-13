<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\PageRepositoryInterface as PageRepository;
use Metrique\Building\Http\Controllers\Controller;
use Metrique\Building\Http\Requests\PageRequest;

class PageController extends Controller
{
    /**
     * Holder for view data
     *
     * @var array
     */
    protected $data = [];

    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'metrique-building::page.index',
        'create' => 'metrique-building::page.create',
        'edit' => 'metrique-building::page.edit',
    ];

    /**
     * List of routes used
     * @var [type]
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
    public function index(PageRepository $page)
    {
        return view($this->views['index'])->with([
            'data' => $page->all(),
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
    public function store(PageRequest $request, PageRepository $page)
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
    public function edit($id, PageRepository $page)
    {
        return view($this->views['edit'])->with([
            'data' => $page->find($id),
            'routes' => $this->routes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PageRequest $request, $id, PageRepository $page)
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
    public function destroy($id, PageRepository $page)
    {
        $page->destroy($id);

        return redirect()->route($this->routes['index']);
    }
}
