<?php

namespace Metrique\Building\Widget;

interface WidgetInterface
{
    /**
     * Render widget
     * @param  string $params
     * @return string
     */
    public function render($params);

    /**
     * Wraps widget content for use with laravel-building
     * @param  string $content
     * @return array
     */
    public function wrap($content);

    /**
     * Merge given json parms with defaults.
     *
     * @param  json $params
     * @return array
     */
    public function params($params);
}
