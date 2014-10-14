<?php
namespace Iono\Console\Application\Traits;

/**
 * read only, Iono/Console Application Component
 * Class Component
 * @package Iono\Console\Application\Traits
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
trait Component
{

    /** @var   */
    private $component;

    /** @var \Iono\Console\Container */
    private $app;

    /**
     * @param $inject
     * @param $app
     * @return void
     */
    public function setComponent($inject, $app)
    {
        $this->component = $inject;
        $this->app = $app;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->app->make($this->component->$name);
    }
}