<?php

namespace Metrique\Building\Contracts\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface SectionRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function withPageId($id, $order = ['order' => 'DESC']);
}