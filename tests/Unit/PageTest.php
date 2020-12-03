<?php

namespace Metrique\Building\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metrique\Building\Tests\TestCase;
use Metrique\Building\Models\Page;

class PageTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function test_page_factory_creates_a_model()
  {
    $page = Page::factory()->create();
    $this->assertTrue(is_a($page, Page::class));
  }
}