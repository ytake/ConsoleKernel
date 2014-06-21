<?php
namespace Iono\Console;

/**
 * Interface ApplicationInterface
 * @package Iono\Console
 */
interface ApplicationInterface
{

    /**
     * @param array $array
     * @return mixed
     */
    public function perform(array $array);
}