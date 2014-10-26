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
    private $version = 0.1;

    /** @var string  */
    private $prefix = "iono.command.";

    /** @var \Iono\Console\Container */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct($container = null)
    {
        parent::__construct($this->name, $this->version);
        $this->container = (is_null($container)) ? new \Iono\Console\Container : $container;
        $this->initialize();
    }

    /**
     * application initialize
     * @return void
     */
    protected function initialize()
    {
        $this->container['component'] = [];
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
        $this->container['prefix'] = $this->prefix;

        // file scan
        $reflection = new Tokenizer($this->container, new Color);

        // application command
        $this->registerCommand(new Commands\ApplicationCommand($reflection, $this->container));

        // application list command
        $this->registerCommand(new Commands\ListCommand($reflection));

        // application generator command
        $this->registerCommand(new Commands\GeneratorCommand($this->container));

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

    /**
     * @param array $paths
     * @return void
     */
    public function installDirectory(array $paths)
    {
        $container = $this->container;
        // directory structure
        $container['directory'] = $paths;
        // register configure
        $container->bindShared('component.config', function () use($container) {
                return \Iono\Console\Application\Configure::registerConfigure($container);
            }
        );
    }
}