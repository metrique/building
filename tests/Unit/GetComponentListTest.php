<?php

namespace Metrique\Building\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Metrique\Building\Services\BuildingServiceInterface;
use Metrique\Building\Tests\TestCase;

class GetComponentListTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->building = resolve(BuildingServiceInterface::class);
    }

    public function test_get_component_list()
    {
        $this->assertEmpty(
            $this->building->getComponentList(
                Config::get('building.components')
            )
        );
    }
}
