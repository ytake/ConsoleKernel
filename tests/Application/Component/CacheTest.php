<?php

class CacheTest extends TestCase
{

    /** @var \Iono\Console\Application\Component\Cache\Factory */
    protected $cache;

    /** @var \Illuminate\Config\Repository  */
    protected $repository;

    /** @var \Iono\Console\Container  */
    protected $container;

    public function setUp()
    {
        $this->cache = new \Iono\Console\Application\Component\Cache\Factory();
        $this->container = new \Iono\Console\Container();
        $configure = new \Iono\Console\Application\Configure();
        $this->container ['prefix'] = "iono.command.";
        $this->container ['directory'] = require TEST_DIR ."/tests/path.php";
        $this->repository = $configure->registerConfigure($this->container );
    }

    public function testInstance()
    {
        $this->assertInstanceOf("Iono\Console\Application\Component\Cache\Factory", $this->cache);
    }

    public function testAdaptor()
    {
        $this->cache->config = $this->repository;
        $this->repository->get('component');

        $reflectionProperty = $this->getProtectProperty($this->cache, 'app');
        $reflectionProperty->setValue($this->cache, $this->container);

        $reflectionProperty = $this->getProtectProperty($this->cache, 'component');
        $reflectionProperty->setValue($this->cache, $this->repository->get('component'));
        $this->assertInstanceOf("Doctrine\Common\Cache\MemcachedCache", $this->cache->adapter('memcached'));

        $this->assertInstanceOf("\Doctrine\Common\Cache\FilesystemCache", $this->cache->adapter('file'));
    }
}
