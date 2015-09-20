<?php

namespace Metrique\Building\Abstracts;

interface WidgetAbstractInterface
{
	public function render($params);
	public function wrap($content);	
}