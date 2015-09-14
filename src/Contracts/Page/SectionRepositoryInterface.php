<?php

namespace Metrique\Building\Contracts\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface SectionRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function byPageId($id, $order = ['order' => 'DESC']);

	/**
	 * Finds all information regarding the section, including page details and structure.
	 * 
	 * @param  int $id
	 * @return array
	 */
	public function findWithAll($id);
}