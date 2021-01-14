<?php

namespace Metrique\Building\View\Components;

use Metrique\Building\Support\InputType;
use Metrique\Building\Support\Component;

class TestComponent extends Component
{
    public function name(): string
    {
        return 'Test component';
    }

    public function properties(): array
    {
        return [
            'title' => InputType::TEXT,
            'description' => InputType::TEXT,
            'link_href' => InputType::TEXT,
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
                'min:3,',
                'max:255'
            ],
            'link_href' => [
                'required',
                'url',
            ],
        ];
    }
}
