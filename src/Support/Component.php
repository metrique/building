<?php

namespace Metrique\Building\Support;

use Faker\Provider\Uuid;
use Metrique\Building\Support\Contracts\boolean;
use Metrique\Building\Support\Contracts\ComponentInterface;

abstract class Component implements ComponentInterface
{
    protected $id;

    public function __construct()
    {
        $this->id = md5(uniqid('', true));
    }

    public function enabled(): bool
    {
        return false;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function multiple(): bool
    {
        return false;
    }

    public function name(): string
    {
        return get_class($this);
    }

    public function order(): int
    {
        return 0;
    }

    public function properties(): array
    {
        return [
            'title' => InputType::HIDDEN,
        ];
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
        ];
    }

    public function values(): array
    {
        return  [];
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled(),
            'id' => $this->id(),
            'multiple' => $this->multiple(),
            'name' => $this->name(),
            'order' => $this->order(),
            'properties' => $this->properties(),
            'rules' => $this->rules(),
            'values' => $this->values(),
        ];
    }
}
