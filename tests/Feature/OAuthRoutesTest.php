<?php

namespace Tests\Feature;

use Tests\TestCase;

class OAuthRoutesTest extends TestCase
{
    public function test_redirect_route_is_registered(): void
    {
        $response = $this->get('/auth/redirect');

        $this->assertTrue($response->isRedirection() || $response->getStatusCode() === 500);
    }
}
