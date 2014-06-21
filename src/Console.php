<?php
namespace Iono\Console;

use Colors\Color;
use Illuminate\Container\Container;
use Iono\Console\Commands\ListCommand;
use Symfony\Component\Console\Application;
use Iono\Console\Commands\CommandInterface;
use Iono\Console\Commands\ApplicationCommand;

/**
 * Class Console
 * @package Iono\Console
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Console extends Application
{

    /** @var string  console application name */
    private $name = "
  _____                     ___                      _
  \_   \___  _ __   ___    / __\___  _ __  ___  ___ | | ___
   / /\/ _ \| '_ \ / _ \  / /  / _ \| '_ \/ __|/ _ \| |/ _ \
/\/ /_| (_) | | | | (_) |/ /___ (_) | | | \__ \ (_) | |  __/
\____/ \___/|_| |_|\___(_)____/\___/|_| |_|___/\___/|_|\___|
Iono.Console";

    /** @var float  console application version */
    private $version = 0.5;

    /** @var string  */
    private $prefix = "iono.command.";

    /** @var Container */
    protected $container;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct($this->name, $this->version);
        $this->container = new Container;
    }

    /**
     * console start
     */
    public function start()
    {
        $this->boot()->run();
    }

    /**
     * @return $this
     */
    protected function boot()
    {
        $this->container['path'] = __DIR__;
        $this->container['prefix'] = $this->prefix;
        // file scan
        $reflection = new Tokenizer($this->container, new Color);

        // application command
        $this->registerCommand(new ApplicationCommand($reflection));

        // application list command
        $this->registerCommand(new ListCommand($reflection));

        return $this;
    }

    /**
     * @param CommandInterface $command
     * @return \Symfony\Component\Console\Command\Command
     */
    public function registerCommand(CommandInterface $command)
    {
        return $this->add($command);
    }

}