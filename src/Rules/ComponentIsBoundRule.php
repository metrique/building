<?php

namespace Metrique\Building\Rules;

use Illuminate\Contracts\Validation\Rule;
use Metrique\Building\Services\BuildingServiceInterface;

class ComponentIsBoundRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!in_array($value, resolve(BuildingServiceInterface::class)->getComponentList())) {
            return false;
        }
        
        return class_exists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The component could not be found.';
    }
}
