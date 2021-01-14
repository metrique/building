<?php

namespace Metrique\Building\Support\Contracts;

interface ComponentInterface
{
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
     * Returns the name for the component.
     * Default is the class name.
     */
    public function name(): string;

    /**
     * Returns if this component should store multiple copies of the data.
     * Default is false.
     */
    public function multiple(): bool;

    /**
     * Returns an integer relating to the position of the compoment.
     * Default is 0.
     *
     * @return int
     */
    public function order(): int;
    
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
     * Holds the values for each property.
     */
    public function values(): array;

    /**
     * Returns the component structure as an array.
     *
     * @return array
     */
    public function toArray() :array;
}
