<?php

namespace Tests\Feature;

use App\User;
use Tests\PassportTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LogoutApiTest extends PassportTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogout()
    {
        $response = $this->withHeaders($this->headersWithToken)
                       ->json('POST', '/api/logout');

        //Log::error(print_r($response));

        $response->assertStatus(200);
    }
}
