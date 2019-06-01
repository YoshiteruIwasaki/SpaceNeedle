<?php

namespace Tests\Feature;

use App\User;
use Tests\PassportLoginTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LoginApiTest extends PassportLoginTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->json('POST', '/api/login', [
            'client_id' => (string) $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $this->user->email,
            'password' => 'secret',
            'grant_type' => 'password',
            'scope' => '*'
        ]);

        $response
            ->assertStatus(200);
    }

    public function testLoginFail()
    {
        $response = $this->json('POST', '/api/login', [
            'client_id' => (string) $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $this->user->email,
            'password' => 'aaaaaa',
            'grant_type' => 'password',
            'scope' => '*'
        ]);

        $response
            ->assertStatus(401);
    }
}
