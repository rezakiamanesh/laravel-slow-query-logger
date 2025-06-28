<?php

namespace SlowQueryLogger\Tests;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;
use SlowQueryLogger\Listeners\QueryLogger;

class QueryLoggerTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('slow-query-logger.threshold_ms', 100);
        $app['config']->set('slow-query-logger.log_path', storage_path('logs/slow-queries-test.log'));
    }

    public function test_it_does_not_log_fast_query()
    {
        $mockFile = \Mockery::mock(Filesystem::class);
        $mockFile->shouldNotReceive('append');

        $logger = new QueryLogger($mockFile);

        $query = new QueryExecuted('SELECT * FROM users', [], 50, null);

        $logger($query);

        $this->assertTrue(true);
    }
}
