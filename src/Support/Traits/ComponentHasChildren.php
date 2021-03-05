<?php

namespace Metrique\Building\Support\Traits;

use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Support\Component;

trait ComponentHasChildren
{
    protected $children = [];

    public function children(bool $resolve = false): array
    {
        $children = collect($this->children)->sortByDesc('order');

        if ($resolve) {
            return $children->map(function ($child) {
                return new $child['class']($child);
            })->toArray();
        }

        return $children->toArray();
    }
    
    public function createChild(Component $component)
    {
        throw_unless(
            $this->multiple(),
            BuildingException::componentNotMultiple()
        );

        throw_unless(
            $this->class() == $component->class(),
            BuildingException::componentTypeShouldMatchParent()
        );

        throw_if(
            collect($this->children)->firstWhere('id', $component->id()),
            BuildingException::componentAlreadyExists($component->id())
        );

        $this->children[] = $component->toArray();
    }

    public function readChild(string $id)
    {
        throw_unless(
            $component = collect($this->children)->firstWhere('id', $id),
            BuildingException::couldNotFindChildComponent($id)
        );

        $class = static::class;
        
        return new $class(
            $component
        );
    }

    public function updateChild(string $id, array $data)
    {
        $child = $this->readChild($id);
        $child->setValuesFor($data);

        $this->children = collect($this->children)->map(function ($value) use ($child) {
            return $value['id'] == $child->id()
                ? $child->toArray()
                : $value;
        })->toArray();

        return $child;
    }

    public function deleteChild(string $id)
    {
        $children = collect($this->children);
        
        throw_unless(
            $children->firstWhere('id', $id),
            BuildingException::couldNotFindChildComponent($id)
        );

        return $this->children = $children->reject(function ($value) use ($id) {
            return $value['id'] == $id;
        })->toArray();
    }
}
