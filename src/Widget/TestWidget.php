<?php

namespace Metrique\Building\Widget;

use Metrique\Building\Widget\Widget;
use Metrique\Building\Widget\WidgetInterface;

class TestWidget extends Widget implements WidgetInterface
{
    public function render($params)
    {
        return $this->wrap('Test widget rendered...');
    }
}
