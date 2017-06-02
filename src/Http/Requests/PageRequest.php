<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;
use Metrique\Building\Http\Requests\Traits\RequestTrait;

class PageRequest extends Request
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
            'title'=>'required',
            'description' => 'required',
            'slug'=>'sometimes|unique:pages,slug,'.$this->route('page'),
            'params'=>'json',
            'meta'=>'json',
            'published'=>'boolean',
        ];
    }
}
