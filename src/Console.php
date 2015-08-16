<?php

namespace Iono\Console;

use Colors\Color;
use Illuminate\Container\Container;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Console
 *
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

    /** @var string */
    private $prefix = "iono.command.";

    /** @var \Iono\Console\Container */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct($container = null)
    {
        parent::__construct($this->name, $this->version);
        $this->container = (is_null($container)) ? new Container : $container;
    }

    /**
     * @param InputInterface|null  $input
     * @param OutputInterface|null $output
     *
     * @return int|void
     * @throws \Exception
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        // $this->boot();
        parent::run($input, $output);
    }

    /**
     * @return $this
     */
    protected function boot()
    {
        return $this;
    }

    /**
     * @param Command $command
     *
     * @return Command
     */
    public function registerCommand(Command $command)
    {
        return $this->add($command);
    }

    /**
     * get container
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
