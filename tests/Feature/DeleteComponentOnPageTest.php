<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\View\Components\TestComponent;

class DeleteComponentOnPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->building = resolve(BuildingServiceInterface::class);
        $this->component = new TestComponent;
        $this->page = Page::factory()->create();
    }

    public function test_component_can_be_deleted_from_page()
    {
        $this->assertTrue(
            $this->building->createComponentOnPage($this->component, $this->page)
        );
        
        $this->assertNotNull(
            collect($this->page->draft)->firstWhere('id', $this->component->id())
        );

        $this->assertTrue(
            $this->building->deleteComponentOnPage($this->component->id(), $this->page)
        );
        
        $this->assertEmpty(
            $this->page->draft
        );
    }

    public function test_invalid_component_id_throws_exception_when_deleting_component_from_page()
    {
        $this->expectException(BuildingException::class);

        $this->building->deleteComponentOnPage(
            uniqid('FAKE', true),
            Page::factory()->create()
        );
    }
}
