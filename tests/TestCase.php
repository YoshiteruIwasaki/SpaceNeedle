<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    //use DatabaseTransactions;

    protected $client;

    public function setUp(): void
    {
        parent::setUp();

        // Password Grant ClientをDBに作成
        $clientRepository = new ClientRepository();

        $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            url('/')
        );

        $this->client = $clientRepository->createPasswordGrantClient(
            null,
            'Test Password Grant Client',
            url('/')
        );
    }
}
