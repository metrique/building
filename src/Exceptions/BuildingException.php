<?php

namespace Metrique\Building\Exceptions;

use Exception;

class BuildingException extends Exception
{
    public static function couldNotRenderForm(): self
    {
        return new static("Could not render form, use the `make` method first.");
    }

    public static function couldNotFindComponentOnPage(string $id): self
    {
        return new static("Could not find component with id `{$id}` in page.");
    }
}
