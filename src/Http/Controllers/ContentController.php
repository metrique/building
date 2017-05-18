<?php

namespace Metrique\Building\Http\Controllers;

use Illuminate\Http\Request;
use Metrique\Building\Http\Controllers\BuildingController;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface as Content;
use Metrique\Building\Repositories\Contracts\PageRepositoryInterface as Page;
use Metrique\Building\Repositories\Contracts\HookRepositoryInterface as Hook;
use Metrique\Building\Support\Slug;

class ContentController extends BuildingController
{
    protected $page;
    protected $content;
    
    protected $views = [
        'index' => 'laravel-building::content.index',
    ];

    public function __construct(Hook $hook, Page $page, Content $content)
    {
        parent::__construct($hook);

        $this->page = $page;
        $this->content = $content;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slug = Slug::slugify(request()->path());
        $page = $this->page->bySlug($slug);
        
        if (is_null($page)) {
            abort(404);
        }

        $this->mergeViewData([
            'contents' => $this->page->publishedContentBySlug($slug),
            'page' => $page,
            'slug' => $slug,
        ]);

        return $this->viewWithData($this->views['index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
