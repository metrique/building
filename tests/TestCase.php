<?php

namespace Metrique\Building\Tests;

use Metrique\Building\BuildingServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            BuildingServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_pages_table.php.stub';

        (new \CreatePagesTable)->up();
    }
}
