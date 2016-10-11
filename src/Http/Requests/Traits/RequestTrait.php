<?php

namespace Metrique\Building\Http\Requests\Traits;

use Illuminate\Contracts\Validation\Validator;
use Metrique\Building\Support\Slug;

trait RequestTrait
{
    protected function modifyRequest()
    {
    }

    protected function populateSlug()
    {
        $modifiedRequest = [];

        if (!request()->has('slug')) {
            $modifiedRequest['slug'] = Slug::slugify($this->input('title', ''));
        }

        return $modifiedRequest;
    }

    protected function getValidatorInstance()
    {
        $modifiedRequest = $this->modifyRequest();

        $this->merge($modifiedRequest);
        request()->merge($modifiedRequest);

        return parent::getValidatorInstance();
    }
}
