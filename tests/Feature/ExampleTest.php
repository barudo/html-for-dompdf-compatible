<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_homepage_redirects_to_awb_preview(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/awb/preview');
    }

    public function test_awb_preview_returns_a_successful_response(): void
    {
        $response = $this->get('/awb/preview');

        $response->assertOk();
        $response->assertSee('HOUSE AIR WAYBILL');
    }
}
