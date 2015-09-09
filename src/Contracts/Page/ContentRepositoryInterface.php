<?php

namespace Metrique\Building\Contracts\Page;

use Metrique\Building\Abstracts\EloquentRepositoryAbstractInterface;

interface ContentRepositoryInterface extends EloquentRepositoryAbstractInterface
{
	public function bySectionId($id);
}