<?php
namespace Iono\Console;

use Illuminate\Config\FileLoader;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Bootstrap
 * @package Iono\Console
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Bootstrap
{

    /** @var Console */
    protected $console;

    /** @var Repository  */
    protected $config;

    /**
     * @param Container $container
     * @param Console $console
     * @return Container
     */
    public function register(Container $container, Console $console)
    {
        $this->config = new Repository(
            new FileLoader(new Filesystem, $container['path'] . '/config'),
            'production'
        );
        $this->presetRegister($container);
        $this->presetRegisterCommands($container, $console);
        return $container;
    }

    /**
     * @param Container $container
     * @return Container
     */
    protected function presetRegister(Container $container)
    {
        $container->instance('config', $this->config);
        $container->instance('files', new \Illuminate\Filesystem\Filesystem);
        with(new \Illuminate\Events\EventServiceProvider($container))->register();
        with(new \Illuminate\Cache\CacheServiceProvider($container))->register();
        return $container;
    }

    /**
     * @param Container $container
     * @param Console $console
     */
    protected function presetRegisterCommands(Container $container, Console $console)
    {
        $console->addCommands([
                $container['command.cache.table'],
                $container['command.cache.clear']
            ]
        );
    }
}