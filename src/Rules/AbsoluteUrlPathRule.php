<?php

namespace Metrique\Building\Rules;

use Illuminate\Contracts\Validation\Rule;

class AbsoluteUrlPathRule implements Rule
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
        if ($value === '/') {
            return true;
        }

        return preg_match('/^\/(([a-z0-9\-]+\/)*[a-z0-9\-]+$)/m', $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans(':attribute must be a valid URL path, and contain a-z or dashes only.');
    }
}
