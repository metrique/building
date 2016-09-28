<?php

namespace Metrique\Building\Contracts\Page;

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
     * The contents of the groups will conform to the block structure.
     *
     * @param  int $id
     * @return array
     */
    public function groupBySectionId($id);

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
     * Creates the markup for relevant input type.
     * Accepted params are classes, type, name, label and value.
     *
     * @param  array  $params
     * @return string
     */
    public function input(array $params);
}
