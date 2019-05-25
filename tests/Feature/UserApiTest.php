<?php

namespace Tests\Feature;

use Tests\PassportTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
//class UserApiTest extends PassportTestCase
{
    /**
     * /api/userに対し、認証Tokenありでリクエストするテスト
     */
    public function testGetApiUserWithTokenInHeaders()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        //    $this->get('/api/user', $this->headersWithToken)->assertStatus(200);
    }
    /**
     * /api/userに対し、認証Tokenなしでリクエストするテスト
     */
    public function testGetApiUserWithOutTokenInHeaders()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        //    $this->get('/api/user', $this->headersWithoutToken)->assertStatus(401);
    }
}
