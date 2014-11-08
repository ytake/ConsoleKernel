<?php
/**
 * database configure
 * @see \Iono\Console\Application\Component\DataStorage\Db
 */
return [

    'db' => [
        /** Fetch Style */
        'fetch' => \PDO::FETCH_CLASS,

        'master' => [
            "driver"   => "pdo_mysql",
            "host"     => "localhost",
            "user"     => "user",
            "password" => "password",
            "dbname"   => "dbname",
            "charset"  => "utf8",
        ],

        'slave' => [
            "driver"   => "pdo_mysql",
            "host"     => "localhost",
            "user"     => "user",
            "password" => "password",
            "dbname"   => "dbname",
            "charset"  => "utf8",
        ],
    ],

    'redis' => [
        'cluster' => false,
        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'database' => 0,
            'password' => null,
        ],
    ],

];