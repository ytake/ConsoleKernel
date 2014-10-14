<?php
namespace Iono\Console\Application\Component\DataStorage;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Iono\Console\Application\Traits\Component;

/**
 * Class Db
 * @package Iono\Console\Application\Component\DataStorage
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Db implements DbInterface
{

    use Component;

    /**
     * @param string $name
     * @return \Doctrine\DBAL\Connection
     * @throws \Doctrine\DBAL\DBALException
     */
    public function connection($name = 'master')
    {
        $dbConfigure = $this->config->get('database')['db'];
        $connection = DriverManager::getConnection($dbConfigure[$name], new Configuration);
        $connection->setFetchMode($dbConfigure['fetch']);
        return $connection;
    }
}