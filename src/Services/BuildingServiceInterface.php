<?php

namespace Metrique\Building\Services;

use Metrique\Building\Models\Page;
use Metrique\Building\Support\Component;

interface BuildingServiceInterface
{
    public function addComponentToPage(Component $component, Page $page): bool;
    public function deleteComponentFromPage(string $componentId, Page $page): bool;
    public function validateComponent(string $class): bool;
    public function getComponent(string $componentId, Page $page): Component;
    public function buildComponentForm(string $componentId, Page $page): FormBuilderInterface;
}
