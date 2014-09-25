<?php
namespace Iono\Console;

use Colors\Color;
use Iono\Console\Commands\CommandInterface;
use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Class Console
 * @package Iono\Console
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class Console extends ConsoleApplication
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

    /** @var \Iono\Console\Container */
    protected $container;

    public function __construct()
    {
        parent::__construct($this->name, $this->version);
        $this->container = new \Iono\Console\Container;
    }

    /**
     * console start
     */
    public function start($app = null)
    {
        $this->boot($app = null)->run();
    }

    /**
     * @param null $app
     * @return $this
     */
    protected function boot($app = null)
    {
        $this->container['prefix'] = $this->prefix;

        // file scan
        $reflection = new Tokenizer($this->container, new Color);

        // application command
        $this->registerCommand(new Commands\ApplicationCommand($reflection, $this->container));

        // application list command
        $this->registerCommand(new Commands\ListCommand($reflection));

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

    /**
     * get container
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}