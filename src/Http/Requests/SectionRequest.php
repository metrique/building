<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;

class SectionRequest extends Request
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
            'title'=>'required|string|unique:page_sections,id,'.$this->get('id'),
            'slug'=>'nullable|string',
            'order'=>'integer',
            'params'=>'json',
            'pages_id'=>'required|exists:pages,id',
            'components_id'=>'required|exists:components,id',
        ];
    }
}
