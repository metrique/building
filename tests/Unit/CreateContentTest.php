<?php

namespace Metrique\Building\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Metrique\Building\Http\Requests\PageRequest;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\View\Components\TestComponent;
use PHPUnit\Framework\Test;

class CreateContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_be_added_to_page_draft()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->addComponentToPage($component, $page)
        );
        
        $this->assertArrayHasKey(
            $component->id(),
            $page->draft
        );
    }

    public function test_duplicate_component_ids_cant_be_added_to_page_draft()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->addComponentToPage($component, $page)
        );

        $this->assertFalse(
            $building->addComponentToPage($component, $page)
        );
        
        $this->assertCount(1, $page->draft);
    }
}
