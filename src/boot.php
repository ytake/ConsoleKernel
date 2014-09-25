<?php
/** @var  $container */
$container = $console->getContainer();

//
$container['directory.structure'] = require __DIR__ . '/bootstrap/path.php';

//
$container['configure'] = \Iono\Console\Application\Configure::registerConfigure($container);

//
$container['path'] = __DIR__ . '/app';