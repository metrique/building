<?php

namespace Metrique\Building\Services;

use Metrique\Building\Support\Component;
use Metrique\Building\Models\Page;
use Metrique\Building\Rules\ComponentIsBoundRule;
use stdClass;

class BuildingService implements BuildingServiceInterface
{
    public function addComponentToPage(Component $component, Page $page): bool
    {
        if (array_key_exists($component->id(), $page->draft)) {
            return false;
        }

        $page->draft = collect(
            $page->draft ?? []
        )
        ->merge([
            $component->id() => $component->toArray()
        ])->toArray();
        
        return $page->save();
    }

    public function deleteComponentFromPage(string $componentId, Page $page): bool
    {
        if (!array_key_exists($componentId, $page->draft)) {
            return false;
        }

        $page->draft = collect(
            $page->draft ?? []
        )->forget(
            $componentId
        );

        return $page->save();
    }

    public function validateComponent(string $class): bool
    {
        return (new ComponentIsBoundRule)->passes(null, $class);
    }
}
