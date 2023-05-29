<?php

namespace Tests\Feature;

use Tests\TestCase;

final class InitialTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertMovedPermanently('/home')->assertStatus(301);
    }
}
