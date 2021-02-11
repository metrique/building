<?php

namespace Metrique\Building\Rules;

use Illuminate\Contracts\Validation\Rule;
use Metrique\Building\Services\BuildingServiceInterface;

class ComponentExists implements Rule
{
    protected $building;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(BuildingServiceInterface $building)
    {
        $this->building = $building;
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
        return true;
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
