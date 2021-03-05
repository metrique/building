<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\View\Components\TestComponent;
use Metrique\Building\View\Components\TestMultipleComponent;

class CreateChildComponentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->firstChild = new TestMultipleComponent;
        $this->firstChild->setValuesFor([
            'title' => 'First child title',
        ]);
            
        $this->component = new TestMultipleComponent;
        $this->component->createChild($this->firstChild);
    }

    public function test_child_component_can_be_created()
    {
        $this->assertCount(
            1,
            $this->component->children()
        );

        $this->assertInstanceOf(
            TestMultipleComponent::class,
            $this->component->readChild(
                $this->firstChild->id()
            )
        );
    }

    public function test_duplicate_child_component_ids_cant_be_created()
    {
        $this->expectException(BuildingException::class);

        $this->component->createChild($this->firstChild);
    }

    public function test_child_component_cant_be_created_on_non_multiple_component()
    {
        $component = new TestComponent;
        $firstChild = new TestComponent;

        $this->assertFalse($component->multiple());
        
        $this->expectException(BuildingException::class);
        
        $component->createChild($firstChild);
    }

    public function test_child_component_cant_be_created_if_a_different_type()
    {
        $component = new TestMultipleComponent;
        $firstChild = new TestComponent;
        
        $this->assertTrue($component->multiple());
        $this->assertNotEquals($component->class(), $firstChild->class());
        
        $this->expectException(BuildingException::class);

        $component->createChild($firstChild);
    }
}
