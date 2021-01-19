<?php

namespace Metrique\Building\View\Components;

use Metrique\Building\Support\InputType;
use Metrique\Building\Support\Component;

class TestComponent extends Component
{
    public function multiple(): bool
    {
        return false;
    }
    
    public function name(): string
    {
        return $this->name ?? 'Test component';
    }

    public function properties(): array
    {
        return [
            'title' => InputType::TEXT,
            'description' => InputType::TEXT,
            'link' => InputType::TEXT,
            'link_text' => InputType::TEXT,
        ];
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'min:3',
                'max:255'
            ],
            'link_href' => [
                'required',
                'url',
            ],
        ];
    }
}