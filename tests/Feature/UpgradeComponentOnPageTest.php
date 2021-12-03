<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;
use Metrique\Building\Support\InputType;
use Metrique\Building\View\Components\TestComponent;

class UpgradeComponentOnPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_component_can_be_upgraded_on_page()
    {
        $building = resolve(BuildingServiceInterface::class);
        $page = Page::factory()->create();

        $component = new TestComponent;

        $modifiedComponent = (new TestComponent)->toArray();
        $modifiedComponent['properties']['modified'] = InputType::TEXT;
        $modifiedComponent['rules']['modified'] = ['required', 'string'];
        $modifiedComponent['themes'][] = 'modified';
        $modifiedComponent = new Component($modifiedComponent);

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );

        $this->assertIsArray(
            $component->setValuesFor([
                'title' => 'New title',
                'description' => 'New description',
                'link' => 'https://example.com',
                'link_text' => 'New link text',
            ])
        );

        $this->assertInstanceOf(
            Component::class,
            $building->updateComponentOnPage($component, $page)
        );

        $this->assertTrue(
            $building->upgradeComponentOnPage($modifiedComponent, $page)
        );

        // Refetch component
        $component = $building->readComponentOnPage(
            $component->id(),
            $page->fresh()
        )->toArray();

        $modifiedComponent = $modifiedComponent->toArray();
        
        // Check properties are upgraded...
        foreach ([
            'properties',
            'rules',
            'themes',
        ] as $property) {
            $this->assertEqualsCanonicalizing(
                $modifiedComponent[$property],
                $component[$property],
                sprintf('Failed asserting `%s` key.', $property)
            );
        }

        // Check blank new values are added...
        foreach ($modifiedComponent['properties'] as $key => $item) {
            $this->assertArrayHasKey($key, $component['values']);
        }
    }
}
