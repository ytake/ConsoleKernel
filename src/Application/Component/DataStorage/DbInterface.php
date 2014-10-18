<?php
namespace Iono\Console\Application\Component\DataStorage;

/**
 * Interface DbInterface
 * @package Iono\Console\Application\Component\DataStorage
 */
interface DbInterface
{

    /**
     * @param string $name
     * @return mixed
     */
    public function connection($name = 'master');
}