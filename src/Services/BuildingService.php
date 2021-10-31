<?php

namespace Metrique\Building\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Support\Component;
use Metrique\Building\Models\Page;
use Metrique\Building\Rules\ComponentIsBoundRule;
use ReflectionClass;

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

    public function renameComponentOnPage(Component $from, Component $to, Page $page): bool
    {
        $page->draft = collect(
            $page->draft
        )->map(function ($value) use ($from, $to) {
            if ($value['class'] !== $from->class()) {
                return $value;
            }

            $value['class'] = $to->class();

            return $value;
        });

        return $page->save();
    }

    public function upgradeComponentOnPage(Component $component, Page $page): bool
    {
        $page->draft = collect(
            $page->draft
        )->map(function ($value) use ($component) {
            if ($value['class'] != $component->class()) {
                return $value;
            }

            $value = $this->upgradeComponentData($value, $component);

            $value['children'] = collect($value['children'])->map(function ($child) use ($component) {
                return $this->upgradeComponentData($child, $component);
            })->toArray();

            return $value;
        })->toArray();

        return $page->save();
    }

    private function upgradeComponentData(array $data, Component $component): array
    {
        $data['multiple'] = $component->multiple();
        $data['properties'] = $component->properties();
        $data['rules'] = $component->rules();
        $data['themes'] = $component->themes();
        $data['values'] = collect($component->properties())->mapWithKeys(function ($item, $key) use ($data) {
            return [
                $key => $data['values'][$key] ?? null
            ];
        })->toArray();

        return $data;
    }

    public function isAComponentClass(string $class): bool
    {
        if (!class_exists($class)) {
            return false;
        }

        return (
            new ReflectionClass($class)
        )->isSubclassOf(Component::class);
    }

    public function getComponentList(array $filter = []): array
    {
        return array_diff(
            Config::get('building.components', []),
            $filter
        );
    }
}
