<?php
/**
 * cache driver configure
 * @see \Iono\Console\Application\Component\Cache\Factory
 */
return [

    /*
     * Supported: "file", "database", "apc", "memcached", "redis", "array"、"riak"
     */
    'driver' => 'memcached',

    /**
     * for file cache driver
     * save file path
     */
    'path' => TEST_DIR . '/tests/tmp/cache',

    /**
     * for memcached cache driver
     */
    'memcached' => [
        [
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100
        ],
    ],

    /* under construct
    'riak' => [
        'host'     => '127.0.0.1',
        'port'     => 8098,
    ]
*/
];
