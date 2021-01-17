<?php

namespace Metrique\Building\Services;

use Metrique\Building\Support\Component;

interface FormBuilderInterface
{
    public function make(Component $component): array;
    public function render();
}
