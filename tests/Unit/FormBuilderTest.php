<?php

namespace Metrique\Building\Tests\Unit;

use DOMDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Services\FormBuilderInterface;
use Metrique\Building\View\Components\TestComponent;

class FormBuilderTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_builder_builds_array_with_attributes_and_properties()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $form = resolve(FormBuilderInterface::class);
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );

        $form = $form->make($component, $page);
        
        $this->assertIsArray($form);
        $this->assertIsArray($form['attributes']);
        $this->assertIsArray($form['properties']);
    
        collect($form['attributes'] + $form['properties'])->map(function ($value) {
            $this->assertArrayHasKey('id', $value);
            $this->assertArrayHasKey('component_id', $value);
            $this->assertArrayHasKey('name', $value);
            $this->assertArrayHasKey('type', $value);
            $this->assertArrayHasKey('value', $value);
            $this->assertIsInt($value['type']);
        });
    }

    public function test_form_render_gives_html_string()
    {
        $building = resolve(BuildingServiceInterface::class);
        $component = new TestComponent;
        $form = resolve(FormBuilderInterface::class);
        $page = Page::factory()->create();

        $this->assertTrue(
            $building->createComponentOnPage($component, $page)
        );

        $form->make($component, $page);
        
        $dom = new DOMDocument;

        $this->assertTrue(
            $dom->loadHTML($form->render())
        );
    }

    public function test_form_render_throws_error_if_make_not_called()
    {
        $this->expectException(BuildingException::class);

        $form = resolve(FormBuilderInterface::class);
        $form->render();
    }
}
