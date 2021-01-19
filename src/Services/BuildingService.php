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
    public function createComponentOnPage(Component $component, Page $page): bool
    {
        throw_if(
            array_key_exists($component->id(), $page->draft),
            BuildingException::couldNotFindComponentOnPage($component->id())
        );

        $page->draft = collect(
            $page->draft ?? []
        )
        ->merge([
            $component->id() => $component->toArray()
        ])->toArray();
        
        return $page->save();
    }

    public function readComponentFromPage(string $componentId, Page $page): Component
    {
        throw_unless(
            array_key_exists($componentId, $page->draft),
            BuildingException::couldNotFindComponentOnPage($componentId)
        );

        return new Component($page->draft[$componentId]);
    }

    public function updateComponentOnPage(Component $component, Page $page): Component
    {
        throw_unless(
            array_key_exists($component->id(), $page->draft),
            BuildingException::couldNotFindComponentOnPage($component->id())
        );

        $page->update([
            'draft' => collect($page->draft)->merge([
                $component->id() => $component->toArray()
            ])->toArray()
        ]);

        return $component;
    }

    public function deleteComponentFromPage(string $componentId, Page $page): bool
    {
        throw_unless(
            array_key_exists($componentId, $page->draft),
            BuildingException::couldNotFindComponentOnPage($componentId)
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
    
    public function buildComponentForm(string $componentId, Page $page): FormBuilderInterface
    {
        $formBuilder = resolve(FormBuilderInterface::class);
        
        $formBuilder->make(
            $this->readComponentFromPage($componentId, $page)
        );

        return $formBuilder->render();
    }
}
