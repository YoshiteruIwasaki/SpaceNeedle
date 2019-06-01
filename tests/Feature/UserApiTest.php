<?php

namespace Tests\Feature;

use Tests\PassportTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserApiTest extends PassportTestCase
//class UserApiTest extends PassportTestCase
{
    /**
     * /api/userに対し、認証Tokenありでリクエストするテスト
     */
    public function testGetUser()
    {
        $response = $this->get('/api/user', $this->headersWithToken);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $this->user->name,
            ]);
    }
    /**
     * /api/userに対し、認証Tokenなしでリクエストするテスト
     */
    public function testGetNullUser()
    {
        $this->get('/api/user', $this->headersWithoutToken)->assertStatus(401);
    }
}
