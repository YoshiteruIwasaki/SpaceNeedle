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
    use RefreshDatabase;
    //use DatabaseTransactions;

    protected $headersWithToken = [];
    protected $scopes = [];
    protected $user;
    protected $client;

    public function setUp(): void
    {
        parent::setUp();

        // Password Grant ClientをDBに作成
        $clientRepository = new ClientRepository();

        $this->client = $clientRepository->createPasswordGrantClient(
            null,
            'Test Password Grant Client',
            url('/')
        );

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
