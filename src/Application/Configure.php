<?php
namespace Iono\Console\Application;

use Iono\Console\Container;

/**
 * Class Configure
 * @package Iono\Application
 */
class Configure
{

    /**
     * @param Container $container
     * @return \Illuminate\Config\Repository
     */
    public static function registerConfigure(Container $container)
    {
        return new \Illuminate\Config\Repository(
            new \Illuminate\Config\FileLoader(
                new \Illuminate\Filesystem\Filesystem(),
                $container['directory.structure']['application.configure']
            ),
            null
        );
    }
} 