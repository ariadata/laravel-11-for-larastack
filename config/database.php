<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('SQLITE_DB_URL'),
            'database' => env('SQLITE_DB_NAME', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('SQLITE_DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('MYSQL_DB_URL'),
            'host' => env('MYSQL_DB_HOST', '127.0.0.1'),
            'port' => env('MYSQL_DB_PORT', '3306'),
            'database' => env('MYSQL_DB_NAME', 'larastack'),
            'username' => env('MYSQL_DB_USER', 'user'),
            'password' => env('MYSQL_DB_PASS', 'pass'),
            'unix_socket' => env('MYSQL_DB_SOCKET', ''),
            'charset' => env('MYSQL_DB_CHARSET', 'utf8mb4'),
            'collation' => env('MYSQL_DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('MARIADB_DB_URL'),
            'host' => env('MARIADB_DB_HOST', '127.0.0.1'),
            'port' => env('MARIADB_DB_PORT', '3306'),
            'database' => env('MARIADB_DB_NAME', 'larastack'),
            'username' => env('MARIADB_DB_USER', 'user'),
            'password' => env('MARIADB_DB_PASS', 'pass'),
            'unix_socket' => env('MARIADB_DB_SOCKET', ''),
            'charset' => env('MARIADB_DB_CHARSET', 'utf8mb4'),
            'collation' => env('MARIADB_DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('PGSQL_DB_URL'),
            'host' => env('PGSQL_DB_HOST', '127.0.0.1'),
            'port' => env('PGSQL_DB_PORT', '5432'),
            'database' => env('PGSQL_DB_NAME', 'larastack'),
            'username' => env('PGSQL_DB_USER', 'user'),
            'password' => env('PGSQL_DB_PASS', 'pass'),
            'charset' => env('PGSQL_DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'mongo' => [
            'driver' => 'mongodb',
            'host' => env('MONGO_DB_HOST', null),
            'port' => env('MONGO_DB_PORT', 27017),
            'database' => env('MONGO_DB_NAME', 'larastack'),
            'username' => env('MONGO_DB_USER', 'user'),
            'password' => env('MONGO_DB_PASS', 'pass'),
            'options' => [
                'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
            ],
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('SQLSRV_DB_URL'),
            'host' => env('SQLSRV_DB_HOST', 'localhost'),
            'port' => env('SQLSRV_DB_PORT', '1433'),
            'database' => env('SQLSRV_DB_NAME', 'larastack'),
            'username' => env('SQLSRV_DB_USER', 'user'),
            'password' => env('SQLSRV_DB_PASS', 'pass'),
            'charset' => env('SQLSRV_DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', null),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', null),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
