<?php

namespace Metrique\Building\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Metrique\Building\Rules\AbsoluteUrlPathRule;

class PageRequest extends FormRequest
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
            'path' => [
                'required',
                'string',
                new AbsoluteUrlPathRule,
                'unique:pages,path',
            ],
            'title' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'image' => [
                'string',
                'url'
            ],
            'meta' => [
                'required',
                'json',
            ],
            'params' => [
                'required',
                'json',
            ],
            'published_at' => [
                'date',
            ],
        ];
    }
}
