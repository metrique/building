<?php

namespace Metrique\Building\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Metrique\Building\Http\Requests\PageRequest;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;

class CreatePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_factory_creates_a_model()
    {
        $page = Page::factory()->create();
    
        $this->assertTrue(
            is_a($page, Page::class)
        );
    }

    public function test_page_request_validates_factory()
    {
        $page = Page::factory()->make();
        $pageRequest = new PageRequest;

        $validator = Validator::make(
            $page->toArray(),
            $pageRequest->rules()
        );

        $this->assertFalse(
            $validator->fails()
        );
    }

    public function test_duplicate_path_fails_validation()
    {
        $page = Page::factory()->make();
        $pageRequest = new PageRequest;
        
        $validator = Validator::make(
            $page->toArray(),
            $pageRequest->rules()
        );

        $this->assertFalse(
            $validator->fails()
        );
        
        // Persist the model before revalidating the same path data.
        Page::create(
            $page->toArray()
        );

        $validator = Validator::make(
            $page->toArray(),
            $pageRequest->rules()
        );

        $this->assertTrue(
            $validator->fails()
        );
    }

    public function test_paths_with_local_pass_validation()
    {
        $pageRequest = new PageRequest;

        collect([
            Page::factory()->english()->make(),
            Page::factory()->englishRoot()->make(),
            Page::factory()->french()->make(),
            Page::factory()->frenchRoot()->make(),
            Page::factory()->german()->make(),
            Page::factory()->germanRoot()->make(),
            Page::factory()->root()->make(),
        ])->each(function ($page) use ($pageRequest) {
            $this->assertFalse(
                Validator::make(
                    $page->toArray(),
                    $pageRequest->rules()
                )->fails()
            );
        });
    }
}
