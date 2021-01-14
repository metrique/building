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
        $page = Page::factory()->create();
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;

        $this->assertTrue(
            $building->addComponentToPage($component, $page)
        );
        
        $this->assertArrayHasKey(
            $component->id(),
            $page->fresh()->source_draft
        );
    }
}
