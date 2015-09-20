<?php

namespace Metrique\Building\Abstracts;

class WidgetAbstract implements WidgetAbstractInterface
{
	public function render($params)
	{
		return $this->wrap('');
	}

	public function wrap($content)
	{
		return [
			[
				['content' => $content]
			]
		];
	}
}