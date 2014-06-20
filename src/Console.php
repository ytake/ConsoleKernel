<?php
namespace Iono\Console;

use Symfony\Component\Console\Application;

/**
 * Class Console
 * @package Iono\Console
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Console extends Application
{

    /** @var string  console application name */
    protected $name = "Iono.Console";

    /** @var float  console application version */
    protected $version = 0.5;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct($this->name, $this->version);
    }

    /**
     * console boot script
     * @throws \Exception
     */
    public function boot()
    {
        $this->run();
    }

}