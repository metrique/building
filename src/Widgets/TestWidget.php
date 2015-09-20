<?php

namespace Metrique\Building\Widgets;

use Metrique\Building\Abstracts\WidgetAbstract;
use Metrique\Building\Contracts\WidgetInterface;

class TestWidget extends WidgetAbstract implements WidgetInterface
{
	public function render($params)
	{
		return $this->wrap('Test widget rendered...');
	}
}