<?php
namespace Iono\Console;

/**
 * Class Container
 * @package Iono\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Container extends \Illuminate\Container\Container
{

    /**
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }
}