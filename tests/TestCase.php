<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use DatabaseTransactions;

    private function prepareForTests()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    /**
     * Default preparation for each test
     *
     */
    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
        $this->prepareForTests();
    }

    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
