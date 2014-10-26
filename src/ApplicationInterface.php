<?php
namespace Iono\Console;

/**
 * Interface ApplicationInterface
 * @package Iono\Console
 * @license http://opensource.org/licenses/MIT MIT
 */
interface ApplicationInterface
{

    /**
     * @param array $array
     * @return mixed
     */
    public function action(array $array);
}