<?php

namespace Metrique\Building\Repositories\Contracts\Page;

use Illuminate\Http\Request;

interface ContentRepositoryInterface
{
    /**
     * Returns section content by section id.
     *
     * @param int $id
     * @return void
     */
    public function bySectionId($id);

    /**
     * Returns grouped content belonging to a Section.
     * The contents of the groups will conform to the component structure.
     *
     * @param  int $id
     * @return array
     */
    public function groupBySectionId($id);

    /**
     * Returns grouped content belonging to a Section where the group is published.
     * The contents of the groups will conform to the component structure.
     *
     * @param  int $id
     * @return array
     */
    public function groupPublishedBySectionId($id);

    /**
     * Store content to the database. Populates and updates based on ID's given.
     * @return mixed
     */
    public function persistWithRequest($pageId, $sectionId);

    /**
     * Creates a unique identifier to use on all inputs.
     * The final format is StructureId::GroupId::ContentId
     *
     * If the input is to create new content then GroupId and ContentId should be a zero.
     *
     * @return array $params
     */
    public function inputName(array $params);

    /**
     * Parses an input name back into an array.
     * The format should be StructureId::GroupId::ContentId
     *
     * @param  string $name
     * @return array
     */
    public function parseInputName(string $name);

    /**
     * Helper method to extract content from a group according to its structure id.
     * @return array
     */
    public function fromGroupByStructure($group, $structureId);

    /**
     * Generates the markup for label tags.
     *
     * @param  string $name
     * @param  string $label
     * @return string
     */
    public function label($name, $label);

    /**
     * Generates the markup for relevant input types.
     * Accepted params are classes, type, name, label and value.
     *
     * @param  array  $params
     * @return string
     */
    public function input(array $params);
}
