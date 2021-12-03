<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\View\Components\TestComponent;

class CreateComponentOnPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->building = resolve(BuildingServiceInterface::class);
        $this->component = new TestComponent;
        $this->page = Page::factory()->create();
    }

    public function test_component_can_be_created()
    {
        $this->assertTrue(
            $this->building->createComponentOnPage($this->component, $this->page)
        );
        
        $this->assertNotNull(
            collect($this->page->draft)->firstWhere('id', $this->component->id())
        );
    }

    public function test_duplicate_component_ids_cant_be_created_on_page()
    {
        $this->assertTrue(
            $this->building->createComponentOnPage($this->component, $this->page)
        );
        
        $this->expectException(BuildingException::class);
        $this->building->createComponentOnPage($this->component, $this->page);
        
        $this->assertCount(1, $this->page->draft);
    }
}
