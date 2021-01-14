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
        $draft = $page->source_draft ?? [];
        $draft[$component->id()] = $component->toArray();
        $page->source_draft = $draft;
        
        return $page->save();
    }

    public function validateComponent(string $class): bool
    {
        return (new ComponentIsBoundRule)->passes(null, $class);
    }
}
