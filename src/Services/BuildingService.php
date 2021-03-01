<?php

namespace Metrique\Building\Services;

use Illuminate\Support\Str;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Support\Component;
use Metrique\Building\Models\Page;
use Metrique\Building\Rules\ComponentIsBoundRule;

class BuildingService implements BuildingServiceInterface
{
    public function fetchContent($page): array
    {
        return collect($page->draft)
            ->filter(fn ($component) => $component['enabled'])
            ->map(function ($component) {
                $component['children'] = collect($component['children'])
                    ->filter(fn ($child) => $child['enabled'])
                    ->sortByDesc('order')
                    ->pluck('values')
                    ->map(function ($component) {
                        return collect($component)->mapWithKeys(function ($value, $key) {
                            return [Str::camel($key) => $value];
                        })->toArray();
                    })
                    ->toArray();

                $component['values'] = collect($component['values'])
                    ->mapWithKeys(function ($value, $key) {
                        return [Str::camel($key) => $value];
                    })->toArray();
                return $component;
            })
            ->sortByDesc('order')
            ->toArray();
    }
    
    protected function findComponent(string $componentId, Page $page): ?array
    {
        return collect($page->draft)->firstWhere('id', $componentId);
    }

    public function createComponentOnPage(Component $component, Page $page): bool
    {
        throw_if(
            $this->findComponent($component->id(), $page),
            BuildingException::componentAlreadyExists($component->id())
        );

        $page->draft = collect(
            $page->draft ?? []
        )->push(
            $component->toArray()
        )->toArray();
        
        return $page->save();
    }

    public function readComponentOnPage(string $componentId, Page $page): Component
    {
        throw_unless(
            $component = $this->findComponent($componentId, $page),
            BuildingException::couldNotFindComponentOnPage($componentId)
        );

        return new Component($component);
    }

    public function updateComponentOnPage(Component $component, Page $page): Component
    {
        throw_unless(
            $this->findComponent($component->id(), $page),
            BuildingException::couldNotFindComponentOnPage($component->id())
        );

        $page->update([
            'draft' => collect(
                $page->draft
            )->map(function ($value) use ($component) {
                return $value['id'] == $component->id()
                    ? $component->toArray()
                    : $value;
            })->toArray()
        ]);

        return $component;
    }

    public function deleteComponentOnPage(string $componentId, Page $page): bool
    {
        throw_unless(
            collect($page->draft)->firstWhere('id', $componentId),
            BuildingException::couldNotFindComponentOnPage($componentId)
        );

        $page->draft = collect(
            $page->draft ?? []
        )->reject(function ($value) use ($componentId) {
            return $value['id'] == $componentId;
        });

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
            $this->readComponentOnPage($componentId, $page)
        );

        return $formBuilder->render();
    }
}
