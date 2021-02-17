<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;
use Metrique\Building\View\Components\TestComponent;

class ReadComponentOnPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->building = resolve(BuildingServiceInterface::class);
        $this->component = new TestComponent;
        $this->page = Page::factory()->create();
    }

    public function test_can_get_component_from_page_by_id()
    {
        $this->assertTrue(
            $this->building->createComponentOnPage($this->component, $this->page)
        );
        
        $this->assertNotNull(
            collect($this->page->draft)->firstWhere('id', $this->component->id())
        );

        $getComponent = $this->building->readComponentOnPage($this->component->id(), $this->page);

        $this->assertInstanceOf(
            Component::class,
            $getComponent
        );

        foreach ($getComponent->toArray() as $key => $value) {
            $this->assertArrayHasKey($key, $this->component->toArray());
            $this->assertEquals($value, $this->component->toArray()[$key]);
        }
    }

    public function test_invalid_component_id_throws_exception()
    {
        $this->assertNotNull($this->page);

        $this->expectException(BuildingException::class);

        $this->building->readComponentOnPage(uniqid('FAKE', true), $this->page);
    }
}
