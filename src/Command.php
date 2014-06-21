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

    /** @var string  command name */
    protected $command;

    /** @var string  command description */
    protected $description;

    /**
     * @return mixed
     */
    abstract function arguments();

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    abstract function action(InputInterface $input, OutputInterface $output);


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
     * command interface configure
     * @return void
     */
    public function configure()
    {
        $this->setName($this->command);
        $this->setDescription($this->description);
        $this->arguments();
    }

}