<?php
namespace Iono\Console\Application\Component\Cache;

use Iono\Console\Application\Traits\Component;

/**
 * Class Factory
 * @package Iono\Console\Application\Component\Cache
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Factory implements CacheInterface
{

    use Component;

    /** @var string  default file cache */
    protected $adapter = 'file';

    /**
     * @param $adapter
     * @return $this
     */
    public function adapter($adapter = 'file')
    {
        $this->adapter = $adapter;
        $adapter = ucfirst($this->adapter);
        $cache = "get{$adapter}Cache";
        return $this->{$cache}();
    }

    /**
     * array cache
     * @return \Doctrine\Common\Cache\ArrayCache
     */
    protected function getArrayCache()
    {
        return new \Doctrine\Common\Cache\ArrayCache();
    }

    /**
     * file cache
     * @return \Doctrine\Common\Cache\FilesystemCache
     */
    protected function getFileCache()
    {
        $cacheConfigure = $this->config->get('cache');
        return new \Doctrine\Common\Cache\FilesystemCache($cacheConfigure['path']);
    }

    /**
     * @return \Doctrine\Common\Cache\MemcachedCache
     */
    protected function getMemcachedCache()
    {
        $cacheConfigure = $this->config->get('memcached');
        $cacheClass = new \Doctrine\Common\Cache\MemcachedCache();
        $memcached = new \Memcached;
        foreach($cacheConfigure as $connect) {
            $memcached->addServer($connect['host'], $connect['port'], $connect['weight']);
        }
        $cacheClass->setMemcached($memcached);
        return $cacheClass;
    }

    /**
     * @todo
     */
    protected function getRiakCache()
    {

    }

    /**
     * @todo
     */
    protected function getRedisCache()
    {

    }
} 