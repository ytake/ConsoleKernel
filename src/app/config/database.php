<?php
/**
 * data storage configure
 */
return [

    'db' => [
        /**
         * PDO Fetch Style
         */
        'fetch' => \PDO::FETCH_CLASS,

        'master' => [
            "driver"   => "pdo_mysql",
            "host"     => "localhost",
            "user"     => "user",
            "password" => "password",
            "dbname"   => "tests",
            "charset"  => "utf8",
        ],

        'slave' => [
            "driver"   => "pdo_mysql",
            "host"     => "localhost",
            "user"     => "user",
            "password" => "password",
            "dbname"   => "tests",
            "charset"  => "utf8",
        ],
    ],
];