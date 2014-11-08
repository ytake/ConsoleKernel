<?php


class ContainerTest extends \PHPUnit_Framework_TestCase
{

    /** @var Iono\Console\Container */
    protected $container;

    public function setUp()
    {
        parent::setUp();
        $this->container = new \Iono\Console\Container();
    }

    public function testInstance()
    {
        $this->assertInstanceOf("Iono\Console\Container", $this->container);
    }

    public function testGetAlias()
    {
        $this->assertInternalType('array', $this->container->getAliases());
        $this->container->alias("TestingAlias", 'testing');
        $this->assertInstanceOf("TestingAlias", $this->container->testing);
    }

    public function testResolve()
    {
        $this->assertInstanceOf("TestingAlias", $this->container->make("TestingAlias"));

    }
}

class TestingAlias
{

}