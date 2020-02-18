<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function testExample()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
