<?php

namespace Tests\Feature;

use App\User;
use Tests\PassportRegisterTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class RegisterApiTest extends PassportRegisterTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $response = $this->json('POST', '/api/register', [
          //  'client_id' => (string) $this->client->id,
          //  'client_secret' => $this->client->secret,
            'name' => 'vuesplash user',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
          //  'grant_type' => 'password',
          //  'scope' => '*'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'access_token' => true,
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUserFail()
    {
        $response = $this->json('POST', '/api/register', [
            //    'client_id' => (string) $this->client->id,
            //    'client_secret' => $this->client->secret,
                'name' => 'vuesplash user',
                'email' => 'dummy@email.com',
                'password' => 'a',
                'password_confirmation' => 'a',
            //    'grant_type' => 'password',
            //    'scope' => '*'
            ]);

        $response->assertStatus(422);
    }
}
