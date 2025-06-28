<?php
namespace SlowQueryLogger\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class QueryLogger
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem = null)
    {
        $this->filesystem = $filesystem ?: new Filesystem;
    }

    public function __invoke(QueryExecuted $query)
    {
        $threshold = config('slow-query-logger.threshold_ms');

        if ($query->time >= $threshold) {
            $sql = $query->sql;
            $bindings = json_encode($query->bindings);
            $time = $query->time;

            $url = Request::fullUrl() ?? 'N/A';
            $method = Request::method() ?? 'N/A';
            $ip = Request::ip() ?? 'N/A';

            $userId = Auth::check() ? Auth::id() : 'guest';

            // route name
            $routeName = Route::currentRouteName() ?? 'unnamed';

            $log = "[" . now() . "]\n";
            $log .= "User: {$userId} | IP: {$ip} | Method: {$method} | URL: {$url} | Route: {$routeName}\n";
            $log .= "Slow Query ({$time}ms): {$sql} | Bindings: {$bindings}\n";
            $log .= str_repeat('-', 150) . "\n";

            $this->filesystem->append(config('slow-query-logger.log_path'), $log);

        }
    }
}
