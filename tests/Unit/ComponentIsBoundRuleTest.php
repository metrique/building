<?php

namespace Metrique\Building\Tests\Unit;

use Metrique\Building\Rules\ComponentIsBoundRule;
use Metrique\Building\Tests\TestCase;

class ComponentIsBoundRuleTest extends TestCase
{
    private $components = [
        'An\Obviously\Non\ExistingComponent' => false,
        'Metrique\Building\View\Components\TestComponent' => true,
    ];

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_url_path_rule_validates()
    {
        $componentIsBoundRule = new ComponentIsBoundRule;

        collect($this->components)->each(fn ($shouldPass, $class) => $this->assertEquals(
            $componentIsBoundRule->passes(null, $class),
            $shouldPass
        ));
    }
}
