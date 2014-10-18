<?php
namespace Iono\Console\Application\Component\DataStorage;

use Illuminate\Redis\Database;
use Iono\Console\Application\Traits\Component;

/**
 * Class Redis
 * @package Iono\Console\Application\Component\DataStorage
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Redis extends Database
{

    use Component;

    /** @var array  */
    protected $clients;

    /**
     * @see \Illuminate\Redis\Database
     */
    public function __construct()
    {

        // $redisConfigure = $this->config;
        /*
        var_dump($redisConfigure);
        if (isset($redisConfigure['cluster']) && $redisConfigure['cluster']) {

            $this->clients = $this->createAggregateClient($redisConfigure);
        } else {
            $this->clients = $this->createSingleClients($redisConfigure);
        }
        */
    }

} 