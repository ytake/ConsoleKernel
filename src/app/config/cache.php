<?php
/**
 *
 */
return [

    /*
     * Supported: "file", "database", "apc", "memcached", "redis", "array"
     */
    'driver' => 'file',

    /*
     *
     */
    'path' => realpath(null) . '/tmp/cache',

];
