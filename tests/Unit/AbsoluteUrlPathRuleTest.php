<?php

namespace Metrique\Building\Tests\Unit;

use Metrique\Building\Rules\AbsoluteUrlPathRule;
use Metrique\Building\Tests\TestCase;

class AbsoluteUrlPathRuleTest extends TestCase
{
    private $paths = [
        '/' => true,
        '/a/path/with-some-dashes' => true,
        '/a/path/with-no-some-dashes' => true,
        '/a-mega/mega-mega/path' => true,
        '/path-of-the-wind' => true,
        '/path' => true,
        '/2014-12-05' => true,
        '/path_with_underscores' => false,
        '//weird//test' => false,
        '/weird//test' => false,
        '/a/long/path/with/a/sample%20resource' => false,
        '/trailing/slashes/should/fail/' => false,
        'trailing/slashes/should/fail/' => false,
        'no/leading/trailing/slashes' => false,
        'https://example.com/i/should/fail' => false,
        '//example.com/another/fail' => false,
        '//example.com/also/failure/' => false,
        '../this/is/a/fail' => false,
        '/../also/a/fail/' => false,
        '/how-about-a?query' => false,
        '/how-about?query=strings' => false
    ];

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_url_path_rule_validates()
    {
        $absoluteUrlPathRule = new AbsoluteUrlPathRule;

        collect($this->paths)->each(function ($shouldPass, $path) use ($absoluteUrlPathRule) {
            $this->assertEquals(
                $absoluteUrlPathRule->passes(null, $path),
                $shouldPass
            );
        });
    }
}
