<?php

namespace Metrique\Building\Services;

use Metrique\Building\Models\Page;
use Metrique\Building\Support\Component;

interface BuildingServiceInterface
{
    public function createComponentOnPage(Component $component, Page $page): bool;
    public function readComponentFromPage(string $componentId, Page $page): Component;
    public function updateComponentOnPage(Component $component, Page $page): Component;
    public function deleteComponentFromPage(string $componentId, Page $page): bool;
    public function validateComponent(string $class): bool;
    public function buildComponentForm(string $componentId, Page $page): FormBuilderInterface;
}
