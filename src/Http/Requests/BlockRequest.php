<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;

class BlockRequest extends Request
{
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
            'title'=>'required|string|unique:building_blocks,id,'.$this->get('id'),
            'slug'=>'nullable|string',
            'params'=>'json',
            'single_item'=>'boolean',
        ];
    }
}
