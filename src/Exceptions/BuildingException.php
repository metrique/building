<?php

namespace Metrique\Building\Exceptions;

use Exception;

class BuildingException extends Exception
{
    public static function componentAlreadyExists(string $id): self
    {
        return new static("Component with id `{$id}` already exists.");
    }

    public static function componentNotMultiple(): self
    {
        return new static("Components can't be nested if they are not 'multiple' components.");
    }

    public static function componentTypeShouldMatchParent(): self
    {
        return new static("Component type should match the parents type.");
    }

    public static function couldNotFindComponentOnPage(string $id): self
    {
        return new static("Could not find component with id `{$id}` in page.");
    }
    
    public static function couldNotFindChildComponent(string $id): self
    {
        return new static("Could not find child component with id `{$id}`.");
    }

    public static function couldNotRenderForm(): self
    {
        return new static("Could not render form, use the `make` method first.");
    }
}
