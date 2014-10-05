<?php
/** @var  $container */
$container = $console->getContainer();

$container['base'] = __DIR__;
// directory structure
$container['directory.structure'] = require __DIR__ . '/bootstrap/path.php';

//
$container->bindShared('component.config', function () use($container) {
        return \Iono\Console\Application\Configure::registerConfigure($container);
    }
);

//
$container['path'] = __DIR__ . '/app';