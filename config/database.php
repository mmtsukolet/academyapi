<?php

return [
    'default' => env('DB_CONNECTION', 'mongodb'),

    'connections' => [
        'sqlite' => [
            'driver'    => 'sqlite',
            'database'  => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix'    => '',
        ],
        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', '127.0.0.1'),
            'port'      => env('DB_PORT', '3306'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => true,
            'engine'    => null,
        ],
        'pgsql' => [
            'driver'    => 'pgsql',
            'host'      => env('DB_HOST', '127.0.0.1'),
            'port'      => env('DB_PORT', '5432'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            'prefix'    => '',
            'schema'    => 'public',
            'sslmode'   => 'prefer',
        ],
        'mongodb' => [
            'driver'    => 'mongodb',
            'host'      => env('DB_HOST', 'localhost'),
            'port'      => env('DB_PORT', 27017),
            'database'  => env('DB_DATABASE', 'app45285157'),
            'charset'   => 'utf8',
            'prefix'    => '',
            'schema'    => 'public'
        ]
    ],
];