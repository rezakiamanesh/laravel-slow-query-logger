<?php
namespace SlowQueryLogger;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use SlowQueryLogger\Listeners\QueryLogger;

class SlowQueryLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/slow-query-logger.php' => config_path('slow-query-logger.php'),
        ], 'config');

        if (config('slow-query-logger.enabled')) {
            DB::listen(function (QueryExecuted $query) {
                (new QueryLogger())->__invoke($query);
            });
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/slow-query-logger.php',
            'slow-query-logger'
        );
    }
}
