<?php
namespace Iono\DataStorage;

use Illuminate\Database\Capsule\Manager;

/**
 * Class DataBase
 * @package Iono\DataStorage
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class DataBase
{

    /** @var array  */
    protected $config;

    /** @var Manager  */
    protected $manager;

    /**
     * @param array $config
     * @param Manager $manager
     */
    public function __construct(array $config, Manager $manager)
    {
        $this->config = $config;
        $this->manager = $manager;
    }

    /**
     * @param $connection
     * @return \Illuminate\Database\Connection
     */
    public function connection($connection = 'master')
    {
        $container = $this->manager->getContainer();
        $container['config']['database.fetch'] = $this->config['fetch'];
        $container['config']['database.default'] = $this->config['default'];
        $this->manager->setContainer($container);

        $connect = $this->config['connections'][$connection];
        $this->manager->addConnection($connect, $connection);
        $this->manager->setCacheManager();
        $this->manager->setAsGlobal();

        return $this->manager->connection($connection);
    }
}