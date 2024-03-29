<?php

namespace Metrique\Building\Support\Contracts;

use Illuminate\Support\Collection;

interface ComponentInterface
{
    /**
     * Returns the entire list of property attributes.
     */
    public function attributes(): array;
    
    /**
     * Gets the cast type for a given property.
     */
    public function attributeFor(string $property): ?int;

    /**
     * Returns a list of validation rules to be used when updating attributes.
     */
    public function attributeRules(): array;

    /**
     * Returns the name of the class
     */
    public function class(): string;

    /**
     * Returns the enabled status of the component.
     * Default is false.
     */
    public function enabled(): bool;
        
    /**
     * Returns the unique id for this component instance.
     * Default is a uniqid() string.
     *
     * @return string
     */
    public function id(): string;

    /**
     * Returns if this component should store multiple copies of the data.
     * Default is false.
     */
    public function multiple(): bool;

    /**
     * Returns the name for the component.
     * Default is the class name.
     */
    public function name(): string;

    /**
     * Returns an integer relating to the position of the compoment.
     * Default is 0.
     *
     * @return int
     */
    public function order(): int;
    
    /**
     * Returns a list of arbitrary parameters
     */
    public function parameters(): array;

    /**
     * Returns a list of properties that the component supports.
     *
     * @return array
     */
    public function properties() :array;

    /**
     * Returns a list of validation rules used to validate a components content.
     *
     * @return array
     */
    public function rules() :array;

    /**
     * Returns the current theme, uses 'default' where no theme is set.
     */
    public function theme(): ?string;

    /**
     * Returns a list of themes that the component can use.
     */
    public function themes() :array;

    /**
     * Holds the values for each property.
     */
    public function values(): array;

    /**
     * Gets the value for any given property. Where the
     * property is an attribute with an InputType, the
     * corresponding class variable is returned instead.
     */
    public function getValueFor(string $property);

    /**
     * Helper method to get multiple values, pass an array of property names.
     */
    public function getValuesFor(array $values): array;

    /**
     * Sets the value for a given property. Where the property
     * is an attribute with an InputType, the corresponding
     * class variables are updated accordingly instead.
     */
    public function setValueFor(string $property, $value = null);

    /**
     * Helper method to set values multiple times, pass an array of property/values.
     */
    public function setValuesFor(array $values): array;

    /**
     * Returns the name of the view to use when rendering the component
     */
    public function view(): ?string;

    /**
     * Returns the component structure as an array.
     *
     * @return array
     */
    public function toArray() :array;

    /**
     * Populates the component structure from an array.
     */
    public function fromArray(array $data);
}
