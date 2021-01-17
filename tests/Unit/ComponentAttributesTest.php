<?php

namespace Metrique\Building\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\View\Components\TestComponent;

class ComponentAttributesTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_gives_attributes_array()
    {
        $component = new TestComponent;

        $this->assertIsArray($component->attributes());
    }

    public function test_component_gives_cast_value_for_property()
    {
        $component = new TestComponent;

        foreach ($component->attributes() as $key => $value) {
            if (!is_null($component->attributeFor($key))) {
                $this->assertIsInt($component->attributeFor($key));
            }
        }
    }

    public function test_component_gives_null_for_property_that_does_not_exit()
    {
        $component = new TestComponent;

        $this->assertNull($component->attributeFor('loosemore'));
    }
}
