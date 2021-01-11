<?php

namespace Metrique\Building\Tests\Unit;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Metrique\Building\Http\Requests\PageRequest;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;

class PageScopePathStartsWithTest extends TestCase
{
    use RefreshDatabase;

    private $paths = [
        'en',
        '/en',
        'en/',
        '/en/',
        'de',
        '/de',
        'de/',
        '/de/',
        'fr',
        '/fr',
        'fr/',
        '/fr/',
        '/france',
    ];

    public function setUp(): void
    {
        parent::setUp();

        Page::factory()->root()->create();
        Page::factory()->englishRoot()->create();
        Page::factory()->english()->create();
        Page::factory()->frenchRoot()->create();
        Page::factory()->french()->create();
        Page::factory()->germanRoot()->create();
        Page::factory()->german()->create();
        Page::factory()->unpublished()->create();
        Page::factory()->french()->create([
            'path' => '/fra'
        ]);
        Page::factory()->french()->create([
            'path' => '/france'
        ]);
        Page::factory()->french()->create([
            'path' => '/france/fr/fra'
        ]);
    }

    public function test_page_scope_path_starts_with()
    {
        collect($this->paths)->each(function ($path) {
            collect(
                Page::pathStartsWith($path)->pluck('path')
            )->each(function ($page) use ($path) {
                
                // Trim any existing slashes, but re-add trailing slash.
                $path = '/' . trim($path, '/') . '/';
                $page = '/' . trim($page, '/') . '/';
                
                // Cut page to same length as path.
                $page = substr($page, 0, strlen($path));
                $this->assertEquals($page, $path);
            });
        });
    }

    public function test_page_scope_path_starts_with_wildcard_gives_all_pages()
    {
        $pages = Page::pathStartsWith(['*', 'ab', 'ce', 'de', 'fg'])->pluck('path');

        $this->assertCount(Page::count(), $pages);
    }
}
