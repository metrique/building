<?php

namespace Metrique\Building\Http\Controllers\Page;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface as Content;
use Metrique\Building\Contracts\Page\GroupRepositoryInterface as Group;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface as Section;
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

    public function __construct(Section $section, Content $content)
    {
        parent::__construct();

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
        $this->mergeViewData([
            'content' => $this->content,
            'data' => [
                'content' => $this->content->groupBySectionId($sectionId),
                'section' => $this->section->findWithStructure($sectionId),
            ]
        ]);

        return view($this->views['index'])->with($this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, $sectionId)
    {
        $this->mergeViewData([
            'content' => $this->content,
            'data' => [
                'content' => $this->content->groupBySectionId($sectionId),
                'section' => $this->section->findWithStructure($sectionId),
            ]
        ]);

        return view($this->views['create'])->with($this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $id, $sectionId)
    {
        $this->content->persistWithRequest($id, $sectionId);

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
    public function edit($id, $sectionId)
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
    public function update(Request $request, $id, $sectionId)
    {
        $this->content->persistWithRequest($id, $sectionId);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $sectionId, $groupId, Group $group)
    {
        $group->destroy($groupId);
        
        return redirect()->back();
    }
}
