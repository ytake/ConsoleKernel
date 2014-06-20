<?php

class ConsoleTest extends \PHPUnit_Framework_TestCase
{

	protected $console;

	public function setUp()
	{
		$this->console = new \Iono\Console\Console();
	}


    public function testConsole()
    {
        var_dump($this->console);
        $this->assertInstanceOf('Iono\Console\Console', $this->console);
    }

}