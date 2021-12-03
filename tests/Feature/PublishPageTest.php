<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Metrique\Building\Http\Requests\PageRequest;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\View\Components\TestComponent;

class PublishPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_page_can_be_published()
    {
        $component = new TestComponent;
        $page = Page::factory()->create();
        
        $building = resolve(BuildingServiceInterface::class);
        $building->createComponentOnPage($component, $page);
        
        $this->assertNull($page->live);

        $building->publishDraft($page);

        $this->assertEquals($page->draft, $page->live);
    }
}
