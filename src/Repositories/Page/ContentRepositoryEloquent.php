<?php

namespace Metrique\Building\Repositories\Page;

use Illuminate\Http\Request;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Eloquent\Page\Content;
use Stringy\Stringy;

class ContentRepositoryEloquent implements ContentRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function bySectionId($id)
    {
        $content = Content::join('building_page_groups as group', 'group.id', '=', 'building_page_groups_id')
            ->select('building_page_contents.*', 'group.order', 'group.published')
            ->where(['building_page_sections_id' => $id])
            ->orderBy('group.order', 'desc')
            ->get();

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function groupBySectionId($id)
    {
        $groups = $this->bySectionId($id)->map(function ($item, $key) {
            // $groupId =
        });


        // $groups = [];

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

        // dd($groups);
        return $groups;
    }

    /**
     * {@inheritdoc}
     */
    public function inputName(array $params)
    {
        $defaults = [
            'structure' => '',
            'group' => 0,
            'content' => 0,
        ];

        return implode('::', array_merge($defaults, $params));
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
