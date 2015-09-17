<?php

namespace Metrique\Building\Contracts\Page;

use Illuminate\Http\Request;
use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface ContentRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	/**
	 * Returns content by Section id.
	 * @param int $id
	 * @return void
	 */
	public function bySectionId($id);

	/**
	 * Returns content by Section id and groups by group id's
	 * The contents of the groups will also conform to the structure given.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function groupBySectionId($id);

	/**
	 * This will sort a groupBySectionId array so that the array of content
	 * matches the given structure.
	 * 
	 * @param  array $structure
	 * @return array
	 */
	public function sortGroupsToStructure($id, array $structure);

	/**
	 * Parses the the name attribute from the request, which may hold several pieces
	 * of key information. For example, the content form has a name attribute where
	 * the value is `0::1` This indicates `group_id::structure_id.`
	 *
	 * A map may also be given which formats the outputted array name. For example,
	 * ['group_id', 'structure_id'] would give [group_id => 23, structure_id => 12]
	 * instead of [0 => 23, 1 => 12].
	 * 
	 * @param Request $request
	 * @param array $map
	 * @param string $delimiter
	 * @return array
	 */
	public function parseRequest(Request $request, array $map = [], $delimiter = '::');

	/**
	 * This takes the parsed request and groups it respective groups. Purely for making the
	 * data easier to work with. You may also 'bolt on' arrays to each item using $include.
	 * 
	 * @param  array  $parseRequestData 
	 * @param array $include
	 * @return array
	 */
	public function groupParseRequest(array $parseRequestData, array $include = []);

	/**
	 * Store content to database.
	 * 
	 * @param  Request $request
	 * @param  int $pageId
	 * @param  int $sectionId
	 * @return bool
	 */
	public function store(Request $request, $pageId, $sectionId);
}