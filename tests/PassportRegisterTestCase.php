<?php
namespace Tests;

use Tests\TestCase;
use App\User;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PassportRegisterTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
}
