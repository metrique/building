<?php

namespace Metrique\Building\Services;

use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Support\Component;
use Metrique\Building\Models\Page;
use Metrique\Building\Rules\ComponentIsBoundRule;
use Metrique\Building\Support\InputType;
use Metrique\Building\View\Components\TestComponent;

class BuildingService implements BuildingServiceInterface
{
    public function addComponentToPage(Component $component, Page $page): bool
    {
        throw_if(
            array_key_exists($component->id(), $page->draft),
            BuildingException::couldNotFindComponentInPage($component->id())
        );

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
        throw_unless(
            array_key_exists($componentId, $page->draft),
            BuildingException::couldNotFindComponentInPage($componentId)
        );

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

    public function getComponent(string $componentId, Page $page): Component
    {
        throw_unless(
            array_key_exists($componentId, $page->draft),
            BuildingException::couldNotFindComponentInPage($componentId)
        );

        return new Component($page->draft[$componentId]);
    }
    
    public function buildComponentForm(string $componentId, Page $page): FormBuilderInterface
    {
        $formBuilder = resolve(FormBuilderInterface::class);
        
        $formBuilder->make(
            $this->getComponent($componentId, $page)
        );

        return $formBuilder->render();
    }
}
