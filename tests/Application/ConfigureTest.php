<?php

class ConfigureTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Iono\Console\Application\Configure */
    protected $configure;

    /** @var  Iono\Console\Container */
    protected $container;

    public function setUp()
    {
        $this->configure = new \Iono\Console\Application\Configure();
        $this->container = new \Iono\Console\Container;
    }

    public function testInstance()
    {
        $this->assertInstanceOf("Iono\Console\Application\Configure", $this->configure);
    }

    public function testRegister()
    {
        $this->container['directory'] = require TEST_DIR ."/tests/path.php";
        $repository = $this->configure->registerConfigure($this->container);
        $this->assertInstanceOf("\Illuminate\Config\Repository", $repository);
        $this->assertInternalType('array', $repository->get('config'));
    }
} 