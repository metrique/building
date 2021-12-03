<?php

namespace Metrique\Building\Services;

use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Support\Component;
use Metrique\Building\Support\InputType;

class FormBuilder implements FormBuilderInterface
{
    protected $form;

    public function form(): array
    {
        return $this->form;
    }

    public function make(Component $component): array
    {
        return $this->form = [
            'attributes' => $this->mapFields($component, $component->attributes()),
            'properties' => $this->mapFields($component, $component->properties())
        ];
    }

    public function render()
    {
        throw_unless(
            isset($this->form),
            BuildingException::couldNotRenderForm()
        );

        $input = collect($this->form['attributes'])->map(function ($value, $key) {
            switch ($value['type']) {
                case InputType::CHECKBOX:
                    return sprintf(
                        '<input type="checkbox" id="%s" name="%s" value="%s"><label for="%s"> %s</label>',
                        $value['name'],
                        $value['name'],
                        1,
                        $value['name'],
                        ucfirst($key)
                    );
                break;
                
                default:
                    return sprintf(
                        '<input type="text" name="%s" value="%s">',
                        $value['name'],
                        $value['value']
                    );
                break;
            }
        });

        return '<div>' . $input->implode(' ') . '</div>';
    }

    protected function mapFields(Component $component, array $attributes): array
    {
        return collect($attributes)->filter()->mapWithKeys(fn ($value, $key) => [
            $key => [
                'id' => ($key . '_' . $component->id()),
                'component_id' => $component->id(),
                'name' => $key,
                'type' => $value,
                'input_type' => InputType::type($value),
                'value' => property_exists($component, $key) ? $component->$key() : $component->getValueFor($key),
            ]
        ])->toArray();
    }
}
