<?php

namespace Metrique\Building\Rules;

use Illuminate\Contracts\Validation\Rule;
use Metrique\Building\Support\RegularExpression;

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

        return preg_match(RegularExpression::ABSOLUTE_URL_PATH, $value) === 1;
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
