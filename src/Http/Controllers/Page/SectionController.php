<?php

namespace Metrique\Building\Http\Controllers\Page;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\BlockRepositoryInterface as BlockRepository;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface as ContentRepository;
use Metrique\Building\Contracts\PageRepositoryInterface as PageRepository;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface as SectionRepository;
use Metrique\Building\Http\Controllers\Controller;
use Metrique\Building\Http\Requests\PageRequest;

class SectionController extends Controller
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
        'index' => 'metrique-building::page.section.index',
        'create' => 'metrique-building::page.section.create',
        'edit' => 'metrique-building::page.section.edit',
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
    public function index($pageId, PageRepository $page, SectionRepository $section)
    {
        $page = $page->find($pageId);

        $data = [
            'page' => $page,
            'section' => $section->byPageId($pageId),
            'routes' => $this->routes,
        ];

        return view($this->views['index'])->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($pageId, PageRepository $page, BlockRepository $block)
    {
        $page = $page->find($pageId);

        $data = [
            'blocks' => $block->formSelect(),
            'page' => $page,
            'routes' => $this->routes,
        ];

        return view($this->views['create'])->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($pageId, Request $request, SectionRepository $section)
    {
        try {
            $section = $section->create([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'order' => $request->input('order'),
                'params' => $request->input('params'),
                'building_pages_id' => $pageId,
                'building_blocks_id' => $request->input('building_blocks_id'),
            ]);
        } catch (\Exception $e) {
            // flash()->error(trans('error.general'));
            return redirect()->back();
        }

        // flash()->success(trans('common.success'));
        return redirect()->route($this->routes['index'], [$pageId, $section->id]);
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
    public function edit($pageId, $sectionId, PageRepository $page, SectionRepository $section, BlockRepository $block)
    {
        $page = $page->find($pageId);
        $section = $section->find($sectionId);

        $data = [
            'page' => $page,
            'section' => $section,
            'blocks' => $block->formSelect(),
            'routes' => $this->routes,
        ];

        return view($this->views['edit'])->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $pageId, $sectionId, SectionRepository $section, ContentRepository $content)
    {
        try {
            if($section->find($sectionId)->building_blocks_id != $request->input('building_blocks_id'))
            {
                $content->destroyBySectionId($sectionId);
            }

            $section->update($sectionId, [
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'order' => $request->input('order'),
                'params' => $request->input('params'),
                'building_pages_id' => $pageId,
                'building_blocks_id' => $request->input('building_blocks_id'),
            ]);
        } catch (\Exception $e) {
            // flash()->error(trans('error.general'));
            return redirect()->back();
        }

        // flash()->success(trans('common.success'));
        return redirect()->route($this->routes['index'], $pageId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($pageId, $sectionId, SectionRepository $section)
    {
        try {
            $section->destroy($sectionId);
        } catch (\Exception $e) {
            // flash()->error(trans('error.general'));
            return redirect()->back();          
        }

        // flash()->success(trans('common.success'));
        return redirect()->route($this->routes['index'], $pageId);
    }
}
