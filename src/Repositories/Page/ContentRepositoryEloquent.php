<?php

namespace Metrique\Building\Repositories\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Metrique\Building\Repositories\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Eloquent\Page\Group;
use Metrique\Building\Eloquent\Page\Content;
use Stringy\Stringy;

class ContentRepositoryEloquent implements ContentRepositoryInterface
{
    protected $delimiter = '--';
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
        return Content::join('page_groups as group', 'group.id', '=', 'page_groups_id')
            ->select('page_contents.*', 'group.order', 'group.published')
            ->where(['page_sections_id' => $id])
            ->orderBy('group.order', 'desc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function groupBySectionId($id)
    {
        return $this->bySectionId($id)->sortBy('id')->groupBy('page_groups_id');
    }

    public function groupPublishedBySectionId($id)
    {
        return $this->bySectionId($id)->where('published', 1)->sortBy('id')->groupBy('page_groups_id');
    }

    public function persistWithRequest($pageId, $sectionId)
    {
        $content = $this->parseRequest();
        $this->persist($content, $pageId, $sectionId);
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
     *
     * @return bool
     */
    protected function persist(Collection $content, $pageId, $sectionId)
    {
        \DB::transaction(function () use ($content, $pageId, $sectionId) {
            $content->each(function ($item, $key) use ($pageId, $sectionId) {
                $groupId = $key;

                // Create!
                if ($groupId === 0) {
                    $group = Group::create([
                        'order' => request(sprintf('order-%s', $groupId), 0),
                        'published' => in_array(0, request('published', [])),
                    ]);

                    $item->each(function ($item, $key) use ($group, $pageId, $sectionId) {
                        $content = Content::create([
                            'content' => $item['content'],
                            'pages_id' => $pageId,
                            'page_sections_id' => $sectionId,
                            'page_groups_id' => $group->id,
                            'component_structures_id' => $item['structure_id'],
                        ]);

                        $group->update([
                            'page_contents_id' => $content->id
                        ]);
                    });

                    return true;
                }

                // Update!
                Group::find($groupId)->update([
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

        if (!strpos($name, $this->delimiter)) {
            return false;
        }

        return collect($this->defaultInputName)->keys()->combine($params);
    }

    /**
     * {@inheritdoc}
     */
    public function fromGroupByStructure($group, $structureId)
    {
        return $group->where('component_structures_id', $structureId)->first();
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
                    htmlspecialchars($params['value'])
                );
                break;

            case 'plonk':
                return $label . sprintf(
                    '<plonk name="%s">%s</plonk>',
                    $params['name'],
                    htmlspecialchars($params['value'])
                );
                break;

            default:
                return $label . sprintf(
                    '<input %s name="%s" type="%s" value="%s">',
                    count($params['classes']) > 0 ? $class : '',
                    $params['name'],
                    $params['type'],
                    htmlspecialchars($params['value'])
                );
                break;
        }
    }
}
