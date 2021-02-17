<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\View\Components\TestComponent;
use Metrique\Building\View\Components\TestMultipleComponent;

class DeleteChildComponentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->firstChild = new TestMultipleComponent;
        $this->firstChild->valuesFor([
            'title' => 'First child title',
        ]);

        $this->component = new TestMultipleComponent;
        $this->component->createChild($this->firstChild);
    }

    public function test_child_component_can_be_deleted()
    {
        $this->assertCount(
            1,
            $this->component->children()
        );

        $this->component->deleteChild(
            $this->firstChild->id()
        );

        $this->assertCount(
            0,
            $this->component->children()
        );
    }

    public function test_invalid_component_id_throws_exception_when_deleting_child_component_from_page()
    {
        $this->expectException(BuildingException::class);

        $this->component->deleteChild(
            uniqid('FAKE', true)
        );
    }
}
