<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;
use Metrique\Building\View\Components\TestComponent;

class UpdateComponentOnPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_be_updated_on_page()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $page = Page::factory()->create();
        
        $updated = [
            'enabled' => true,
            'order' => 999,
            'name' => 'New name',
            'title' => 'New title',
            'description' => 'New description',
            'link' => 'https://example.com',
            'link_text' => 'New link text',
        ];

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );

        $this->assertIsArray(
            $component->setValuesFor($updated)
        );
        
        $this->assertInstanceOf(
            Component::class,
            $building->updateComponentOnPage($component, $page)
        );

        // Refetch component
        $component = $building->readComponentOnPage(
            $component->id(),
            $page->fresh()
        );
        
        foreach ($updated as $key => $expected) {
            $this->assertEquals(
                $expected,
                $component->getValueFor($key),
                "Matching `$key` failed."
            );
        }
    }
}
