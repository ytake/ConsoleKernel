<?php
namespace Iono\Console\Application\Traits;

use StdClass;
use Iono\Console\Container;

/**
 * read only, Iono/Console Application Component
 * Class Component
 * @package Iono\Console\Application\Traits
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
trait Component
{

    /** @var   */
    protected $component;

    /** @var \Iono\Console\Container */
    protected $app;

    /**
     * @param stdClass $inject
     * @param Container $app
     * @return void
     */
    public function setComponent(stdClass $inject, Container $app)
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