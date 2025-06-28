<?php
return [
    // Enable or disable the package
    'enabled' => true,

    // Minimum milliseconds a query should take to log
    'threshold_ms' => 100,

    // Log file path
    'log_path' => storage_path('logs/slow-queries.log'),
];

