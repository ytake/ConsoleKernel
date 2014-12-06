<?php


class ConsoleTest extends TestCase
{
    /** @var \Iono\Console\Console  */
    protected $console;

    public function setUp()
    {
        $this->console = new \Iono\Console\Console();
    }

    public function testInstance()
    {
        $this->assertInstanceOf("Iono\Console\Console", $this->console);
    }

    public function testInstall()
    {
        $this->console->installDirectory(require TEST_DIR ."/tests/path.php");
        $container = $this->console->getContainer();
        $this->assertInstanceOf('Iono\Console\Container', $container);
        $this->assertInstanceOf('Illuminate\Config\Repository', $container['component.config']);
    }

    public function testBoot()
    {
        $this->setConfigure($this->console->getContainer());
        $reflectionMethod = $this->getProtectMethod($this->console, 'boot');
        $this->assertInstanceOf('Iono\Console\Console', $reflectionMethod->invoke($this->console));
    }

}
