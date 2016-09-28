<?php

namespace Metrique\Building\Repositories\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Eloquent\Page\Group;
use Metrique\Building\Eloquent\Page\Content;
use Stringy\Stringy;

class ContentRepositoryEloquent implements ContentRepositoryInterface
{
    protected $delimiter = '::';
    protected $defaultInputName = [
        'structure_id' => '',
        'group_id' => 0,
        'content_id' => 0,
    ];

    /**
     * {@inheritdoc}
     */
    public function bySectionId($id)
    {
        return Content::join('building_page_groups as group', 'group.id', '=', 'building_page_groups_id')
            ->select('building_page_contents.*', 'group.order', 'group.published')
            ->where(['building_page_sections_id' => $id])
            ->orderBy('group.order', 'desc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function groupBySectionId($id)
    {
        return $this->bySectionId($id)->groupBy('building_page_groups_id');

        /* Temp..
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
        */
    }

    public function create(array $data)
    {
    }

    public function persistWithRequest($pageId, $sectionId)
    {
        $content = $this->parseRequest();

        switch (request('type')) {
            case 'single':
                $this->persistSingle($content, $pageId, $sectionId);
                break;

            case 'multi':
                break;

            default:
                throw new \Exception('metrique\laravel-building: Persist type is not valid.');
                break;
        }
    }

    /**
     * Parses and groups request object ready for persistence.
     *
     * @return Collection
     */
    protected function parseRequest()
    {
        return collect(request()->all())->filter(function ($item, $key) {
            if (!is_string($item)) {
                return false;
            }

            return (bool) $this->parseInputName($key);
        })->map(function ($item, $key) {
            return $this->parseInputName($key)->merge([
                'content' => $item,
            ]);
        })->groupBy('group_id');
    }

    /**
     * Persist single component item to database.
     * @return bool
     */
    protected function persistSingle(Collection $content, $pageId, $sectionId)
    {
        \DB::transaction(function () use ($content) {
            $content->each(function ($item, $key) {
                $groupId = $key;

                // Create
                if ($groupId === 0) {
                    $groupId = Group::create([
                        'order' => request(sprintf('order-%s', $groupId), 0),
                        'published' => in_array(0, request('published', [])),
                    ])->id;

                    $item->each(function ($item, $key) use ($groupId, $pageId, $sectionId) {
                        Content::create([
                            'content' => $item['content'],
                            'building_pages_id' => $pageId,
                            'building_page_sections_id' => $sectionId,
                            'building_page_groups_id' => $groupId,
                            'building_block_structures_id' => $item['structure_id'],
                        ]);
                    });

                    return true;
                }

                // Update!
                $group = Group::update($groupId, [
                    'order' => request(sprintf('order-%s', $groupId), 0),
                    'published' => in_array($groupId, request('published', [])),
                ]);

                $item->each(function ($item, $key) {
                    Content::find($item['content_id'])->update([
                        'content' => $item['content']
                    ]);
                });

                return true;
            });
        });
    }

    /**
     * {@inheritdoc}
     */
    public function inputName(array $params)
    {
        return implode($this->delimiter, array_merge($this->defaultInputName, $params));
    }

    /**
     * {@inheritdoc}
     */
    public function parseInputName(string $name)
    {
        $params = explode($this->delimiter, $name);

        if (!($params & strpos($name, $this->delimiter))) {
            return false;
        }

        return collect($this->defaultInputName)->keys()->combine($params);
    }

    /**
     * {@inheritdoc}
     */
    public function label($name, $label)
    {
        return sprintf('<label for="%s">%s</label>', $name, $label);
    }

    /**
     * {@inheritdoc}
     */
    public function input(array $params)
    {
        $defaults = [
            'classes' => [],
            'label' => '',
            'name' => '',
            'type' => 'text',
            'value' => '',
        ];

        $params = array_merge($defaults, $params);
        $class = sprintf(' class="%s"', implode(' ', $params['classes']));
        $label = $this->label($params['name'], $params['label']);

        switch ($params['type']) {
            case 'text-area':
                return $label . sprintf(
                    '<textarea %s name="%s">%s</textarea>',
                    count($params['classes']) > 0 ? $class : '',
                    $params['name'],
                    $params['value']
                );
                break;

            default:
                return $label . sprintf(
                    '<input %s name="%s" type="%s" value="%s">',
                    count($params['classes']) > 0 ? $class : '',
                    $params['name'],
                    $params['type'],
                    $params['value']
                );
                break;
        }
    }
}
