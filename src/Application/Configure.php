<?php
namespace Iono\Console\Application;

use Iono\Console\Container;

/**
 * Class Configure
 * @package Iono\Console\Application
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
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
                $container['directory']['application.configure']
            ),
            null
        );
    }
} 