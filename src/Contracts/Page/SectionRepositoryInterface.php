<?php

namespace Metrique\Building\Contracts\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface SectionRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	/**
	 * Finds section regarding the section by page id.
	 * 
	 * @param  int $id
	 * @return array
	 */
	public function byPageId($id, $order = ['order' => 'DESC']);

	/**
	 * Finds all information regarding the section by section id, including page details and structure.
	 * 
	 * @param  int $id
	 * @return array
	 */
	public function findWithAll($id);
}