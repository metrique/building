<?php

namespace Metrique\Building\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Metrique\Building\Rules\ComponentIsBoundRule;
use Metrique\Building\Services\BuildingServiceInterface;

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
        return $this->fetchRules(
            $this->request->get(
                '_parent',
                $this->request->get('_id')
            )
        );
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
        
        if ($this->request->get('_type', '') == 'attributes') {
            return $rules->intersectByKeys(
                $component->attributes()
            )->toArray();
        }

        if ($this->request->get('_type', '') == 'multiple') {
            return $rules->intersectByKeys(
                collect($component->properties())->except('name')
            )->toArray();
        }

        if ($this->request->get('_type', '') == 'properties') {
            return $rules->intersectByKeys(
                $component->properties()
            )->toArray();
        }
    }
}
