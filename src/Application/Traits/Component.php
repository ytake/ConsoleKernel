<?php
namespace Iono\Console\Application\Traits;

use Illuminate\Container\Container;

/**
 * read only, Iono/Console Application Component
 * Class Component
 * @package Iono\Console\Application\Traits
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
trait Component
{

    protected $component;

    /**
     * @param $container
     * @return Container
     */
    public function setComponent($container)
    {
        return $this->component = $container;
    }
}