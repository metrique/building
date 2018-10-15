<?php

namespace Metrique\Building\Http\Controllers\Page;

use Illuminate\Http\Request;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface as Content;
use Metrique\Building\Repositories\Contracts\Page\GroupRepositoryInterface as Group;
use Metrique\Building\Repositories\Contracts\HookRepositoryInterface as Hook;
use Metrique\Building\Repositories\Contracts\Page\SectionRepositoryInterface as Section;
use Metrique\Building\Http\Controllers\BuildingController;
use Metrique\Building\Http\Requests\PageRequest;

class ContentController extends BuildingController
{
    /**
    * List of routes used
    * @var array
    */
    protected $routes = [
        'single.index' => 'page.section.index',
        'multi.index' => 'page.section.content.index',
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
        'single.index' => 'laravel-building::page.content.single.index',
        'multi.index' => 'laravel-building::page.content.multi.index',
        'single.form' => 'laravel-building::page.content.single.form',
        'multi.form' => 'laravel-building::page.content.multi.form',
        'single.create' => 'laravel-building::page.content.single.create',
        'multi.create' => 'laravel-building::page.content.multi.create',
        'single.edit' => 'laravel-building::page.content.single.edit',
        'multi.edit' => 'laravel-building::page.content.multi.edit',
        'single.form' => 'laravel-building::page.content.single.form',
        'multi.form' => 'laravel-building::page.content.multi.form',
    ];

    public function __construct(Hook $hook, Section $section, Content $content)
    {
        parent::__construct($hook);

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

        if ($this->viewData['data']['section']->component->single_item) {
            return $this->viewWithData($this->views['single.index']);
        }

        return $this->viewWithData($this->views['multi.index']);
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

        if ($this->viewData['data']['section']->component->single_item) {
            return $this->viewWithData($this->views['single.create']);
        }

        return $this->viewWithData($this->views['multi.create']);
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

        if ($request->type == 'single') {
            return redirect()->route($this->routes['single.index'], $id);
        }

        return redirect()->route($this->routes['multi.index'], [$id, $sectionId]);
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

        if ($request->type == 'single') {
            return redirect()->route($this->routes['single.index'], [$id]);
        }

        return redirect()->route($this->routes['multi.index'], [$id, $sectionId]);
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
