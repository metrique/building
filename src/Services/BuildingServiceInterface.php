<?php

namespace Metrique\Building\Services;

use Metrique\Building\Models\Page;
use Metrique\Building\Support\Component;

interface BuildingServiceInterface
{
    public function fetchContent($page): array;
    public function createComponentOnPage(Component $component, Page $page): bool;
    public function readComponentOnPage(string $componentId, Page $page): Component;
    public function updateComponentOnPage(Component $component, Page $page): Component;
    public function deleteComponentOnPage(string $componentId, Page $page): bool;
    public function validateComponent(string $class): bool;
    public function buildComponentForm(string $componentId, Page $page): FormBuilderInterface;
    public function renameComponentOnPage(Component $from, Component $to, Page $page): bool;
    public function upgradeComponentOnPage(Component $component, Page $page): bool;
    public function isAComponentClass(string $class): bool;
}
