<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;
use Metrique\Building\Http\Requests\Traits\RequestTrait;

class SectionRequest extends Request
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
            'title'=>'required|string',
            'order'=>'integer',
            'params'=>'json',
            'pages_id'=>'required|exists:pages,id',
            'components_id'=>'required|exists:components,id',
        ];
    }
}
