<?php
/**
 *
 */
return [

    /*
     * Supported: "file", "database", "apc", "memcached", "redis", "array"、"riak"
     */
    'driver' => 'file',

    /*
     *
     */
    'path' => realpath(null) . '/tmp/cache',

];
