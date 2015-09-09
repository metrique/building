<?php

namespace Metrique\Building\Contracts\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface SectionRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function byPageId($id, $order = ['order' => 'DESC']);
	public function findWithAll($id);
}