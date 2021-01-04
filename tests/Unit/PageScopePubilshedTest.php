<?php

namespace Metrique\Building\Tests\Unit;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Metrique\Building\Http\Requests\PageRequest;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;

class PageScopePublishedTest extends TestCase
{
    use RefreshDatabase;

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
        Page::factory()->notYetPublished()->create();
    }

    public function test_published_scope_gives_only_published_pages()
    {
        Page::published()->each(function ($page) {
            $this->assertNotNull($page->published_at);
            $this->assertTrue(
                now()->gt($page->published_at)
            );
        });
    }

    public function test_page_is_published_accessor_works()
    {
        Page::all()->each(function ($page) {
            if (is_null($page->published_at)) {
                $this->assertFalse($page->is_published);
            }

            if (now()->lt($page->published_at)) {
                $this->assertFalse($page->is_published);
            }
        });
    }
}
