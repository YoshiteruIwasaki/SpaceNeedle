<?php
namespace Tests;

use Tests\TestCase;
use App\User;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PassportTestCase extends TestCase
{
    protected $headersWithToken = [];
    protected $scopes = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // ユーザーをDBに作成
        $this->user = factory(User::class)->create();

        $response = $this->json('POST', '/api/login', [
                'client_id' => (string) $this->client->id,
                'client_secret' => $this->client->secret,
                'username' => $this->user->email,
                'password' => 'secret',
                'grant_type' => 'password',
                'scope' => '*'
            ]);

        $array = $response->json();
        // リクエストのヘッダーを設定
        $this->headersWithToken['Authorization'] = 'Bearer '.$array['access_token'];
        $this->headersWithToken['Accept'] = 'application/json';
    }
}
