# Laravel Slow Query Logger

A Laravel package to log **slow SQL queries** for performance analysis and debugging.

![Packagist Version](https://img.shields.io/packagist/v/rezakiamanesh/laravel-slow-query-logger)
![License](https://img.shields.io/github/license/rezakiamanesh/laravel-slow-query-logger)

---

## 📦 Installation

You can install the package via Composer:

```bash
composer require rezakia/slow-query-logger
```

## ⚙️ Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --tag=slow-query-logger-config
```

This is the content of the published config file:

```bash
return [
'enabled' => true,
'threshold_ms' => 100, // Minimum time (in ms) for a query to be considered slow
'log_path' => storage_path('logs/slow-queries.log'),
];
```

## 🧪 Testing

Run tests using:

```bash
./vendor/bin/phpunit | php artisan test
```

Or if using Testbench:

```bash
vendor/bin/testbench
```
## 🚀 Usage
Once installed, the package automatically logs slow queries. You can view them in the log file specified in your config.

Each log entry contains:

User ID (or guest)

Request method and URL

Route name

SQL query and bindings

Execution time

## ✅ Example Log

```text
[2025-06-28 11:12:13]
User: 1 | IP: 127.0.0.1 | Method: GET | URL: http://localhost/users | Route: users.index
Slow Query (350ms): SELECT * FROM users WHERE email = ? | Bindings: ["test@example.com"]
--------------------------------------------------------------------------------------
```

## 📄 License
MIT © Reza Kiamanesh

- `rezakiamanesh`
- `reza kia`

---

