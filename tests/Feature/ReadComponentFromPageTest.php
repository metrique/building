<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;
use Metrique\Building\View\Components\TestComponent;

class ReadComponentFromPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_component_from_page_by_id()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );
        
        $this->assertArrayHasKey(
            $component->id(),
            $page->draft
        );

        $getComponent = $building->readComponentFromPage($component->id(), $page);

        $this->assertInstanceOf(
            Component::class,
            $getComponent
        );

        foreach ($getComponent->toArray() as $key => $value) {
            $this->assertArrayHasKey($key, $component->toArray());
            $this->assertEquals($value, $component->toArray()[$key]);
        }
    }

    public function test_invalid_component_id_throws_exception()
    {
        $building = resolve(BuildingServiceInterface::class);
        $page = Page::factory()->create();

        $this->assertNotNull($page);

        $this->expectException(BuildingException::class);

        $building->readComponentFromPage(uniqid('FAKE', true), $page);
    }
}
