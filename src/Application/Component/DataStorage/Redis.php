<?php
namespace Iono\Console\Application\Component\DataStorage;

use Predis\Client;
use Iono\Console\Application\Traits\Component;

/**
 * Class Redis
 * @package Iono\Console\Application\Component\DataStorage
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class Redis implements DbInterface
{

    use Component;

    /** @var array  */
    protected $clients;

    /** @var array  */
    protected $options = [
        'cluster' => 'redis'
    ];

    /**
     * @param string $name
     * @return mixed|void
     */
    public function connection($name = 'default')
    {
        $this->connectionResolver();
        return $this->clients[$name];
    }

    /**
     * @return void
     */
    protected function connectionResolver()
    {
        $redisConfigure = $this->config->get('database')['redis'];
        if (isset($redisConfigure['cluster']) && $redisConfigure['cluster']) {
            $this->clients = $this->createCluster($redisConfigure);
        } else {
            $this->clients = $this->createSingleClients($redisConfigure);
        }
    }

    /**
     * @param array $servers
     * @return Client
     */
    protected function createCluster(array $servers)
    {
        if(isset($servers['cluster'])) {
            unset($servers['cluster']);
        }
        return new Client($servers, $this->options);
    }

    /**
     * @param array $servers
     * @return array
     */
    protected function createSingleClients(array $servers)
    {
        if(isset($servers['cluster'])) {
            unset($servers['cluster']);
        }
        $clients = [];
        foreach ($servers as $key => $server) {
            $clients[$key] = new Client($server);
        }
        return $clients;
    }
} 