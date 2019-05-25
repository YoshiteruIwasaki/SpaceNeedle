<?php

namespace Tests\Feature;

use App\User;
use Tests\PassportTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
//class RegisterApiTest extends PassportTestCase
{
    /**
     * A basic feature test example.
     *
     */
    public function testCreateUser()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        /*
        $data = [
            'name' => 'vuesplash user',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', '/api/register', $data);

        $response
                    ->assertStatus(201)
                    ->assertJson([
                        'created_at' => true,
                    ]);
                    */
    }
}
