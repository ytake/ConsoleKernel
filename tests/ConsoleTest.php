<?php
/**
 * Class ConsoleTest
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ConsoleTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iono\Console\Console  */
    protected $console;

    public function setUp()
    {
        $this->console = new \Iono\Console\Console();
    }

    public function testConsole()
    {
        $this->assertInstanceOf('Iono\Console\Console', $this->console);
    }

    public function testBoot()
    {
        $reflectionClass = new ReflectionClass($this->console);
        $reflectionMethod = $reflectionClass->getMethod('boot');
        $reflectionMethod->setAccessible(true);
        $invoke = $reflectionMethod->invoke($this->console, 'boot');
        $this->assertInstanceOf("Iono\Console\Console", $invoke);
    }
}