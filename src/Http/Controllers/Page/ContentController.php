<?php

namespace Metrique\Building\Http\Controllers\Page;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface as ContentRepository;
use Metrique\Building\Contracts\Page\GroupRepositoryInterface as GroupRepository;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface as SectionRepository;
use Metrique\Building\Http\Controllers\Controller;
use Metrique\Building\Http\Requests\PageRequest;

class ContentController extends Controller
{
    /**
    * List of routes used
    * @var array
    */
    protected $routes = [
        'index' => 'page.section.content.index',
        'create' => 'page.section.content.create',
        'store' => 'page.section.content.store',
        'edit' => 'page.section.content.edit',
        'update' => 'page.section.content.update',
        'destroy' => 'page.section.content.destroy',
    ];

    /**
     * List of views used.
     *
     * @var array
     */
    protected $views = [
        'index' => 'metrique-building::page.content.index',
        'single.form' => 'metrique-building::page.content.single.form',
        'multi.form' => 'metrique-building::page.content.multi.form',
        'create' => 'metrique-building::page.content.create',
        'edit' => 'metrique-building::page.content.edit',
        'form' => 'metrique-building::page.content.form',
    ];

    public function __construct(SectionRepository $section, ContentRepository $content)
    {
        $this->section = $section;
        $this->content = $content;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id, $sectionId)
    {
        $data = [
            'routes' => $this->routes,
            'views' => $this->views,
            'data' => [
                'content' => $this->content->groupBySectionId($sectionId),
                'section' => $this->section->findWithStructure($sectionId),
            ]
        ];

        // dd($data);

        return view($this->views['index'])->with($data);
        /*
        // General content pulling stuff.
        $section = $this->section->findWithAll($sectionId);
        $content = $this->content->groupBySectionId($sectionId);

        $structure = $section['block']['structure'];
        $singleItem = $section['block']['single_item'] ? true : false;

        // Data/View binding
        $this->data = array_merge($this->data, [
            'content' => $content,
            'counter' => 0,
            'pageId' => $pageId,
            'section' => $section,
            'sectionId' => $sectionId,
            'singleItem' => $singleItem,
            'structure' => $structure,
            'routes' => $this->routes,
            'views' => $this->views,
        ]);

        // Please move this to somewhere else...
        if($singleItem)
        {
            return view($this->views['single.index'])->with($this->data);
        }

        return view($this->views['multi.index'])->with($this->data);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, $sectionId)
    {
        $data = [
            'routes' => $this->routes,
            'views' => $this->views,
            'content' => $this->content,
            'data' => [
                'content' => $this->content->groupBySectionId($sectionId),
                'section' => $this->section->findWithStructure($sectionId),
            ]
        ];

        // dd($data);

        return view($this->views['create'])->with($data);
        /*
        // General content pulling stuff.
        $section = $this->section->findWithAll($sectionId);
        $content = $this->content->groupBySectionId($sectionId);
        $structure = $section['block']['structure'];
        $singleItem = $section['block']['single_item'] ? true : false;

        // Data/View binding
        $data = [
            'content' => $content,
            'pageId' => $pageId,
            'section' => $section,
            'sectionId' => $sectionId,
            'singleItem' => $singleItem,
            'structure' => $structure,
            'routes' => $this->routes,
        ];

        return view($this->views['create'])->with($data);
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $pageId, $sectionId)
    {
        try {
            $this->content->store($request, $pageId, $sectionId);
            // flash()->success(trans('common.success'));
        } catch (Exception $e) {
            // flash()->error(trans('error.general'));
        }

        return redirect()->back();
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
    public function edit($pageId, $sectionId)
    {
        abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($pageId, $sectionId, Request $request)
    {
        try {
            $this->content->store($request, $pageId, $sectionId);
            // flash()->success(trans('common.success'));
        } catch (\Exception $e) {
            // flash()->error(trans('error.general'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($pageId, $sectionId, $groupId, GroupRepository $group)
    {
        try {
            $group->destroy($groupId);
            // flash()->success(trans('common.success'));
        } catch (\Exception $e) {
            // flash()->error(trans('error.general'));
        }
        return redirect()->back();
    }
}
