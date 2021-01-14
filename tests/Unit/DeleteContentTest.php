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

class DeleteContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_be_deleted_from_page_draft()
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

        $this->assertTrue(
            $building->deleteComponentFromPage($component->id(), $page)
        );

        $this->assertEmpty(
            $page->draft
        );
    }

    public function test_invalid_component_id_returns_false_when_deleting_component_from_page_draft()
    {
        $building = resolve(BuildingServiceInterface::class);
        
        $this->assertFalse(
            $building->deleteComponentFromPage(
                'invalidcomponentid',
                Page::factory()->create()
            )
        );
    }
}
