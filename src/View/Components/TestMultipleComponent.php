<?php

namespace Metrique\Building\View\Components;

use Metrique\Building\Support\InputType;
use Metrique\Building\Support\Component;

class TestMultipleComponent extends Component
{
    public function multiple(): bool
    {
        return true;
    }
    
    public function name(): string
    {
        return $this->name ?? 'Test multiple component';
    }

    public function properties(): array
    {
        return [
            'title' => InputType::TEXT,
        ];
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:191',
            ],
        ];
    }
}
