<?php

namespace Metrique\Building\Services;

use Metrique\Building\Support\Component;

interface FormBuilderInterface
{
    public function form(): array;
    public function make(Component $component): array;
    public function render();
}
