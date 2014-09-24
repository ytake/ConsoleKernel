<?php
namespace Iono\Console;

use Colors\Color;
use Iono\Console\Commands\ListCommand;
use Iono\Console\Commands\CommandInterface;
use Iono\Console\Commands\ApplicationCommand;
use Doctrine\Common\Annotations\AnnotationReader;
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

    /** @var AnnotationReader */
    protected $reader;

    /** @var Bootstrap  */
    protected $bootstrap;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct($this->name, $this->version);
        $this->container = new \Iono\Console\Container;
        $this->bootstrap = new \Iono\Console\Bootstrap;
        $this->provider = new Provider;
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
        $this->container['path'] = __DIR__ . "/app";
        $this->container['prefix'] = $this->prefix;

        $this->container = $this->bootstrap->register($this->container, $this);

        // file scan
        $reflection = new Tokenizer($this->container, new Color);

        // application command
        $this->registerCommand(new ApplicationCommand($reflection, $this->container));

        // application list command
        $this->registerCommand(new ListCommand($reflection));

        return $this;
    }

    protected function provider(Container $container)
    {

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