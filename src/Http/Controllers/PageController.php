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
        'index' => 'cms.page.index',
        'create' => 'cms.page.create',
        'store' => 'cms.page.store',
        'edit' => 'cms.page.edit',
        'update' => 'cms.page.update',
        'destroy' => 'cms.page.destroy',
        'section.index' => 'cms.page.section.index',
    ];

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PageRepository $page)
    {
        $this->data = array_merge($this->data, [
            'pages' => $page->all(['id', 'title', 'slug', 'published'], ['title' => 'asc']),
            'routes' => $this->routes,
        ]);

        return view($this->views['index'])->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data = array_merge($this->data, [
            'routes' => $this->routes,
        ]);

        return view($this->views['create'])->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PageRequest $request, PageRepository $page)
    {
        try {
            $page->create([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'params' => $request->input('params'),
                'meta' => $request->input('meta'),
                'published' => $request->input('published') == 1 ? 1 : 0,
            ]);
        } catch (AbstractException $e) {
            // flash()->error(trans('error.general'));
            return redirect()->back();
        }

        // flash()->success(trans('common.success'));
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
        $this->app->abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, PageRepository $page)
    {
        $this->data = array_merge($this->data, [
            'page' => $page->find($id, ['id', 'title', 'slug', 'params', 'meta', 'published']),
            'routes' => $this->routes,
        ]);

        return view($this->views['edit'])->with($this->data);
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
        try {
            $page->update($id, [
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'params' => $request->input('params'),
                'meta' => $request->input('meta'),
                'published' => $request->input('published') == 1 ? 1 : 0,
            ]);

        } catch (AbstractException $e) {
            // flash()->error(trans('general.error'));
            return redirect()->back();
        }

        // flash()->success(trans('common.success'));
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
        try {
            $page->destroy(2382);
        } catch (AbstractException $e) {
            dd('super duper faile...');
            // flash()->error(trans('error.general'));
            return redirect()->back();          
        }

        // flash()->success(trans('common.success'));
        return redirect()->route($this->routes['index']);
    }
}
