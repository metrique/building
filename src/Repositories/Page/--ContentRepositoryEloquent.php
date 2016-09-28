<?php

namespace Metrique\Building\Repositories\Page;

use Illuminate\Http\Request;
use Metrique\Building\Abstracts\EloquentRepositoryAbstract;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface;
use Stringy\Stringy;

class ContentRepositoryEloquent extends EloquentRepositoryAbstract implements ContentRepositoryInterface
{
    protected $modelClassName = 'Metrique\Building\Eloquent\Page\Content';

    /**
     * {@inheritdoc}
     */
    public function bySectionId($id)
    {
        return $this->model
            ->join('building_page_groups as group', 'group.id', '=', 'building_page_groups_id')
            ->select('building_page_contents.*', 'group.order', 'group.published')
            ->where(['building_page_sections_id' => $id])
            ->orderBy('group.order', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function groupBySectionId($id)
    {
        $groups = [];

        foreach ($this->bySectionId($id) as $key => $value) {
            $content = [];

            // Create group
            $groupId = $value['building_page_groups_id'];

            if (!array_key_exists($groupId, $groups)) {
                $groups[$groupId] = [];
            }

            // Re map content, groupId -> sectionId -> content
            $groups[$groupId][$value['building_block_structures_id']] = $value;
        }

        return $groups;
    }

    /**
     * {@inheritdoc}
     */
    public function parseRequest(Request $request, array $map = [], $delimiter = '::')
    {
        $data = [];

        foreach ($request->all() as $key => $content) {
            if (!$keys = $this->requestKeyIsValid($key, $delimiter)) {
                continue;
            }

            $keys = $this->mapParseRequest($keys, $map, isset($content) ? $content : '');
            $data[] = $keys;
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function groupParseRequest(array $parseRequestData, array $include = [])
    {
        $group = [];

        foreach ($parseRequestData as $key => $value) {
            // If the item has a group_id
            if (!array_key_exists('group_id', $value)) {
                continue;
            }

            // If group doesn't exist then create!
            if (!array_key_exists($value['group_id'], $group)) {
                $group[$value['group_id']] = [];
            }

            // Add includes...
            $value = array_merge($value, $include);

            // Add the item to its respective group...
            $group[$value['group_id']][] = $value;
        }

        return $group;
    }

    /**
     * {@inheritdoc}
     */
    public function store(Request $request, $pageId, $sectionId)
    {
        $content = $this->parseRequest($request, $map = ['group_id', 'structure_id', 'content_id']);
        $content = $this->groupParseRequest($content, ['page_id'=>$pageId, 'section_id'=>$sectionId]);

        switch ($request->input('type')) {
            case 'single':
                return $this->storeSingle($request, $content);
            break;

            case 'multi':
                return $this->storeMulti($request, $content);
            break;

            default:
                throw new \Exception('Building request type was not valid.');
            break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function destroyBySectionId($id)
    {
        return $this->model->where('building_page_sections_id', $id)->delete();
    }
    
    private function storeSingle(Request $request, array $content)
    {
        foreach ($content as $key => $value) {

            // Get group key...
            $groupId = $key;

            // dd($request->all());
            // Create a new group + new content.
            if ($groupId === 0) {
                \DB::transaction(function () use ($value, $groupId,$request) {
                    $groupId = $this->app->make('Metrique\Building\Contracts\Page\GroupRepositoryInterface')->create([
                        'order' => $request->get('order-'.$groupId, 0),
                        'published' => in_array(0, $request->get('published', []))
                    ])->id;

                    foreach ($value as $key => $content) {
                        // dump($key);
                        $content['group_id'] = $groupId;

                        $this->create([
                            'content' => $content['_content'],
                            'building_pages_id' => $content['page_id'],
                            'building_page_sections_id' => $content['section_id'],
                            'building_page_groups_id' => $content['group_id'],
                            'building_block_structures_id' => $content['structure_id'],
                            'building_block_types_id' => 1, // Do we even need this?
                        ]);
                    }
                });

                continue;
            }

            // Existing group, or update!
            \DB::transaction(function () use ($value, $groupId,$request) {
                $group = $this->app->make('Metrique\Building\Contracts\Page\GroupRepositoryInterface')->update($groupId, [
                    'order' => $request->get('order-'.$groupId),
                    'published' => in_array($groupId, $request->get('published', [])),
                ]);

                foreach ($value as $key => $content) {
                    $this->update($content['content_id'], [
                        'content' => $content['_content'],
                    ]);
                }
            });
        }

        return true;
    }

    private function storeMulti(Request $request, array $content)
    {
        $this->storeSingle($request, $content);
    }

    /**
     * Helper to validate that the request name is valid.
     * @param  string $key
     * @param  string $delimiter
     * @return mixed
     */
    private function requestKeyIsValid($key, $delimiter)
    {
        $keys = explode($delimiter, $key);

        if (!($keys & Stringy::create($key)->contains($delimiter))) {
            return false;
        }

        return $keys;
    }

    /**
     * Help to maps the keys to an associative array.
     * @param  $keys
     * @param  array $map
     * @param  string $content
     * @return array
     */
    private function mapParseRequest($keys, $map, $content)
    {
        // Add content to array.
        $keys['_content'] = $content;

        // Shout this be mapped?
        $shouldMap = count($map) > 0 ? true : false;

        foreach ($map as $key => $value) {
            if (array_key_exists($key, $keys)) {
                $keys[$value] = $keys[$key];
                unset($keys[$key]);
            }
        }

        return $keys;
    }
}
