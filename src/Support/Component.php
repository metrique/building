<?php

namespace Metrique\Building\Support;

use Metrique\Building\Support\Contracts\ComponentInterface;

use function PHPUnit\Framework\throwException;

class Component implements ComponentInterface
{
    private $class;
    private $enabled;
    private $id;
    private $multiple;
    protected $name;
    private $order;
    private $parameters;
    private $properties;
    private $rules;
    private $values;

    protected $attributes = [
        'class' => null,
        'enabled' => InputType::CHECKBOX,
        'id' => null,
        'multiple' => null,
        'name' => InputType::TEXT,
        'order' => InputType::NUMBER,
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

        $this->values = collect(
            $this->properties()
        )->map(function ($value, $key) {
            return null;
        })->toArray();
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

    public function attributeRules(): array
    {
        return  [
            'enabled' => [
                'required',
                'boolean',
            ],
            'name' => [
                'required',
                'string',
            ],
            'order' => [
                'required',
                'integer',
                'min:0',
                'max:65535'
            ],
            'parameters' => [
                'array'
            ],
        ];
    }

    public function class(): string
    {
        return $this->class ?? static::class;
    }

    public function enabled(): bool
    {
        return (bool) $this->enabled ?? false;
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
        return $this->values;
    }

    public function valueFor(string $property, $value = null)
    {
        // Catch if property is in attributes, and has method.
        if (isset($this->attributes[$property]) && method_exists($this, $property)) {
            return is_null($value) || is_null($this->attributes[$property])
                ? $this->$property()
                : $this->$property = $value;
        }

        $values = $this->values();

        if (!array_key_exists($property, $values)) {
            return null;
        }

        if (!is_null($value)) {
            $values[$property] = $value;
        }
        
        $this->values = $values;

        return $values[$property];
    }

    public function valuesFor(array $data): array
    {
        foreach ($data as $property => $value) {
            $this->valueFor($property, $value);
        }

        return $this->toArray();
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
            'rules' => array_merge(
                $this->attributeRules(),
                $this->rules()
            ),
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
