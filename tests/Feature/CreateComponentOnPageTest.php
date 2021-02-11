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

    public function test_component_can_be_created_on_page()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );
        
        $this->assertNotNull(
            collect($page->draft)->firstWhere('id', $component->id())
        );
    }

    public function test_duplicate_component_ids_cant_be_created_on_page()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );
        
        $this->expectException(BuildingException::class);
        $building->createComponentOnPage($component, $page);
        
        $this->assertCount(1, $page->draft);
    }
}
