<?php
namespace Iono\Console;

use Iono\Console\Commands\CommandInterface;
use Symfony\Component\Console\Command\Command as SfCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Command
 * @package Iono\Console
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
abstract class Command extends SfCommand implements CommandInterface
{

    /** @var Console */
    protected $console;

    /**
     * @return mixed
     */
    abstract function argument();

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    abstract function action(InputInterface $input, OutputInterface $output);


    /**
     * @param Console $console
     */
    public function __construct(Console $console)
    {
        $this->console = $console;
    }

    /**
     * @param SfCommand $class
     * @return SfCommand
     */
    public function register(SfCommand $class)
    {
        return $this->console->add($class);
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->action($this->input, $this->output);
    }

    /**
     *
     */
    public function configure()
    {
        $this->argument();
    }

}