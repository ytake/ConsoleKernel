<?php
namespace Iono\Console\Application;

use Illuminate\Container\Container;


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