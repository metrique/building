<?php

namespace Metrique\Building\Abstracts;

use Illuminate\Container\Container;

abstract class WidgetAbstract implements WidgetAbstractInterface
{
	public function __construct(Container $app)
	{
		$this->app = $app;
	}

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