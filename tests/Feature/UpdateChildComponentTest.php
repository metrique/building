<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Exceptions\BuildingException;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Support\Component;
use Metrique\Building\View\Components\TestMultipleComponent;

class UpdateChildComponentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->firstChild = new TestMultipleComponent();
        $this->firstChild->setValuesFor([
            'title' => 'First child title',
        ]);

        $this->component = new TestMultipleComponent;
        $this->component->createChild($this->firstChild);
    }

    public function test_child_components_can_be_updated()
    {
        $title = uniqid('TITLE', true);

        $this->component->updateChild($this->firstChild->id(), [
            'title' => $title
        ]);

        $updatedFirstChild = $this->component->readChild($this->firstChild->id());
        
        $this->assertEquals(
            $title,
            $updatedFirstChild->getValueFor('title')
        );
    }

    public function test_invalid_component_id_throws_exception()
    {
        $this->expectException(BuildingException::class);

        $this->component->updateChild(uniqid('FAKE', true), [
            'title' => uniqid('TITLE', true)
        ]);
    }
}
