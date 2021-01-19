<?php

namespace Metrique\Building\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Metrique\Building\Rules\ComponentIsBoundRule;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;

class ComponentEditRequest extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'component' => [
                'required',
                new ComponentIsBoundRule,
            ],
        ];
    }

    public function prepareForValidation()
    {
        dd($this);
        collect($this->request)->each(function ($value, $key) {
            dump($key, $value);
        });
    }
}
