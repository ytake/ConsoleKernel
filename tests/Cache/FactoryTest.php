<?php

/**
 * Class FactoryTest
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Iono\Console\Application\Component\Cache\Factory $cache */
    protected $cache;

    public function setUp()
    {
        $this->cache = new \Iono\Console\Application\Component\Cache\Factory;
    }

    public function testInstance()
    {
        $this->assertInstanceOf("\Iono\Console\Application\Component\Cache\Factory", $this->cache);
    }

    public function testArrayCache()
    {
        var_dump($this->cache->adapter());
    }
} 