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

    public function test_component_can_be_deleted_from_page()
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

        $this->assertTrue(
            $building->deleteComponentOnPage($component->id(), $page)
        );
        
        $this->assertEmpty(
            $page->draft
        );
    }

    public function test_invalid_component_id_throws_exception_when_deleting_component_from_page()
    {
        $building = resolve(BuildingServiceInterface::class);
        
        $this->expectException(BuildingException::class);

        $building->deleteComponentOnPage(
            'invalidcomponentid',
            Page::factory()->create()
        );
    }
}
