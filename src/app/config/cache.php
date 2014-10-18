<?php
/**
 * cache driver configure
 * @see \Iono\Console\Application\Component\Cache\Factory
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
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
    'path' => realpath(null) . '/tmp/cache',

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
];
