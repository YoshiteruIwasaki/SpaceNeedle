<?php
namespace Tests;

use Tests\TestCase;
use App\User;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PassportLoginTestCase extends TestCase
{
    protected $headersWithToken = [];
    protected $scopes = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // ユーザーをDBに作成
        $this->user = factory(User::class)->create();
    }
}
