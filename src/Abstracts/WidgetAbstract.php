<?php

namespace Metrique\Building\Abstracts;

use Illuminate\Container\Container;

abstract class WidgetAbstract implements WidgetAbstractInterface
{
	protected $defaults = [];
	
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

	/**
     * Merge given json parms with defaults.
     * 
     * @param  json $params
     * @return array
     */
    public function params($params)
    {
        if(empty($params))
        {
            return $this->defaults;
        }

        if( ! is_json($params))
        {
            return $this->defaults;
        }

        $params = json_decode($params, true);
        $params = array_merge($this->defaults, array_intersect_key($params, $this->defaults));

        return $params;
    }
}