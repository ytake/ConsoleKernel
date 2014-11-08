<?php
/**
 * application components
 */
return [
    /**
     *
     */
    // database component
    'db' => "\\Iono\\Console\\Application\\Component\\DataStorage\\Db",
    // cache component
    'cache' => "\\Iono\\Console\\Application\\Component\\Cache\\Factory",
    // redis component
    'redis' => "\\Iono\\Console\\Application\\Component\\DataStorage\\Redis",
];