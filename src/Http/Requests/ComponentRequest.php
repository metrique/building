<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;
use Metrique\Building\Http\Requests\Traits\RequestTrait;

class ComponentRequest extends Request
{
    use RequestTrait;

    public function modifyRequest()
    {
        return $this->populateSlug();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|unique:components,title,'.$this->route('component'),
            'slug' => 'required|string|unique:components,slug,'.$this->route('component'),
            'params' => 'json',
            'single_item' => 'boolean',
        ];
    }
}
