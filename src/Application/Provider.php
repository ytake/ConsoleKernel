<?php
namespace Iono\Console\Application;

use Iono\Console\Container;

/**
 * Class Provider
 * @package Iono\Console\Application
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
abstract class Provider
{

    /** @var Container  */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return void
     */
    abstract public function register();


}