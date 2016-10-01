<?php

namespace Metrique\Building\Http\Controllers\Page;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\ComponentRepositoryInterface as Component;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface as Content;
use Metrique\Building\Contracts\PageRepositoryInterface as Page;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface as Section;
use Metrique\Building\Http\Controllers\Controller;
use Metrique\Building\Http\Requests\PageRequest;
use Metrique\Building\Http\Requests\SectionRequest;

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
     * List of routes used.
     *
     * @var array
     */
    protected $routes = [
        'index' => 'page.section.index',
        'create' => 'page.section.create',
        'store' => 'page.section.store',
        'edit' => 'page.section.edit',
        'update' => 'page.section.update',
        'destroy' => 'page.section.destroy',
        'content.index' => 'page.section.content.index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id, Page $page, Section $section)
    {
        $this->mergeViewData([
            'data' => [
                'page' => $page->find($id),
                'section' => $section->byPageId($id),
            ]
        ]);

        return $this->viewWithData($this->views['index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, Page $page, Component $component)
    {
        $this->mergeViewData([
            'data' => [
                'page' => $page->find($id),
                'components' => $component->formBuilderSelect()
            ]
        ]);

        return $this->viewWithData($this->views['create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($id, SectionRequest $request, Section $section)
    {
        $section->createWithRequest();

        return redirect()->route($this->routes['index'], [$id]);
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
    public function edit($id, $sectionId, Page $page, Section $section, Component $component)
    {
        $this->mergeViewData([
            'data' => [
                'page' => $page->find($id),
                'section' => $section->find($sectionId),
                'components' => $component->formBuilderSelect(),
            ],
        ]);

        return $this->viewWithData($this->views['edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SectionRequest $request, $id, $sectionId, Section $section, Content $content)
    {
        // TODO: hould this be moved to section->update?
        // if ($section->find($sectionId)->components_id != $request->input('components_id')) {
        //     $content->destroyBySectionId($sectionId);
        // }
        $section->updateWithRequest($sectionId);

        return redirect()->route($this->routes['index'], $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $sectionId, Section $section)
    {
        $section->destroy($sectionId);

        return redirect()->route($this->routes['index'], $id);
    }
}
