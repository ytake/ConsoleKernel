<?php
namespace Iono\Console\Traits;

/**
 * Container accessor
 * trait ComponentTrait
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
trait ComponentTrait
{

    /** @var \Iono\Console\Container */
    protected $app;

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->app[$name];
    }

}