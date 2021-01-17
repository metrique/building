<?php

namespace Metrique\Building\Support;

use Faker\Provider\Uuid;
use Illuminate\Support\Collection;
use Metrique\Building\Support\Contracts\boolean;
use Metrique\Building\Support\Contracts\ComponentInterface;

class Component implements ComponentInterface
{
    private $class;
    private $enabled;
    private $id;
    private $multiple;
    private $name;
    private $order;
    private $parameters;
    private $properties;
    private $rules;
    private $values;

    protected $attributes = [
        'class' => null,
        'id' => null,
        'name' => InputType::TEXT,
        'order' => InputType::NUMBER,
        'enabled' => InputType::CHECKBOX,
        'multiple' => null,
        'parameters' => null,
    ];

    public function __construct(array $data = null)
    {
        $this->setUp();
        
        if (isset($data)) {
            $this->fromArray($data);
        }
    }

    private function setUp()
    {
        $this->id = md5(uniqid('', true));

        $this->values = collect($this->properties())->map(function ($value, $key) {
            return null;
        })->merge(
            array_intersect_key($this->toArray(), $this->attributes)
        )->toArray();
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function attributeFor(string $property): ?int
    {
        $attributes = $this->attributes();

        if (array_key_exists($property, $attributes)) {
            return $attributes[$property];
        }

        return null;
    }

    public function class(): string
    {
        return $this->class ?? static::class;
    }

    public function enabled(): bool
    {
        return $this->enabled ?? false;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function multiple(): bool
    {
        return $this->multiple ?? false;
    }

    public function name(): string
    {
        return $this->name ?? $this->class();
    }

    public function order(): int
    {
        return $this->order ?? 0;
    }

    public function parameters(): array
    {
        return $this->parameters ?? [];
    }

    public function properties(): array
    {
        return $this->properties ?? [];
    }

    public function rules(): array
    {
        return $this->rules ?? [];
    }

    public function values(): array
    {
        return $this->values ?? [];
    }

    public function valueFor(string $property)
    {
        $values = $this->values();

        if (array_key_exists($property, $values)) {
            return $values[$property];
        }

        return null;
    }

    public function toArray(): array
    {
        return [
            'attributes' => $this->attributes(),
            'class' => $this->class(),
            'enabled' => $this->enabled(),
            'id' => $this->id(),
            'multiple' => $this->multiple(),
            'name' => $this->name(),
            'order' => $this->order(),
            'parameters' => $this->parameters(),
            'properties' => $this->properties(),
            'rules' => $this->rules(),
            'values' => $this->values(),
        ];
    }

    public function fromArray(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $this->toArray();
    }
}
