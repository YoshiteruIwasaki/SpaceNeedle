<?php
namespace Tests;

use Tests\TestCase;
use App\User;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class PassportLoginTestCase extends TestCase
{
    use DatabaseTransactions;

    protected $headersWithToken = [];
    protected $headersWithoutToken = [];
    protected $scopes = [];
    protected $user;
    protected $client;

    public function setUp(): void
    {
        parent::setUp();

        // Password Grant ClientをDBに作成
        $clientRepository = new ClientRepository();

        $this->client2 = $clientRepository->createPasswordGrantClient(
            null,
            'Test Password Grant Client',
            url('/')
        );

        // ユーザーをDBに作成
        $this->user = factory(User::class)->create();
    }
}
