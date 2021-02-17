<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;
use Metrique\Building\View\Components\TestComponent;
use Metrique\Building\View\Components\TestMultipleComponent;

class ReadChildComponentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->firstChild = new TestMultipleComponent();
        $this->firstChild->valuesFor([
            'title' => 'First child title',
        ]);

        $this->component = new TestMultipleComponent;
        $this->component->createChild($this->firstChild);
    }

    public function test_can_get_child_from_component_by_id()
    {
        $this->assertCount(
            1,
            $this->component->children()
        );

        $this->assertEquals(
            $this->firstChild->toArray(),
            $this->component->readChild(
                $this->firstChild->id()
            )->toArray()
        );
    }

    public function test_invalid_component_id_throws_exception()
    {
        $this->expectException(BuildingException::class);
        
        $this->component->readChild(uniqid('FAKE', true));
    }
}
