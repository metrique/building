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
        return $this->fetchRules($this->_id);
    }

    public function prepareForValidation()
    {
        abort_unless(
            (new ComponentIsBoundRule)->passes(
                null,
                $this->request->get('_component')
            ),
            403
        );

        $this->merge(
            collect($this->request)->mapWithKeys(function ($value, $key) {
                return [
                    str_replace($this->_id . ':', '', $key) => $value
                ];
            })->toArray()
        );
    }

    private function fetchRules($componentId)
    {
        $component = resolve(BuildingServiceInterface::class)
            ->readComponentOnPage(
                $componentId,
                $this->page
            );
        
        $rules = collect($component->rules());

        if ($this->request->get('_type') == 'attributes') {
            $rules = $rules->intersectByKeys(
                $component->attributes()
            );
        }

        if ($this->request->get('_type') == 'properties') {
            $rules = $rules->intersectByKeys(
                $component->properties()
            );
        }

        return $rules->toArray();
    }
}
