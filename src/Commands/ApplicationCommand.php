<?php
namespace Iono\Console\Commands;

use Iono\Console\Command;
use Iono\Console\Tokenizer;
use Iono\Console\Container;
use Iono\Console\Exception\ClassNotFoundException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ApplicationCommand
 * @package Iono\Console\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class ApplicationCommand extends Command
{

    /** @var string  */
    protected $command = "console:action";

    /** @var string */
    protected $description = "application scripts";

    /** @var Tokenizer */
    protected $tokenizer;

    /** @var Container */
    protected $container;

    /**
     * @param Tokenizer $tokenizer
     * @param Container $container
     */
    public function __construct(Tokenizer $tokenizer, Container $container)
    {
        parent::__construct();
        $this->tokenizer = $tokenizer;
        $this->container = $container;
    }

    /**
     * @return mixed|void
     */
    public function arguments()
    {
        $this->addArgument('action', InputArgument::REQUIRED, 'specify your script name');
        $this->addOption('time', null, InputOption::VALUE_NONE, 'display execution time');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
     * @throws \Iono\Console\Exception\ClassNotFoundException
     */
    public function action(InputInterface $input, OutputInterface $output)
    {
        $query = [];
        $parsed = parse_url($input->getArgument('action'));
        $displayTime = $input->getOption('time');
        // search application
        $application = $this->tokenizer->getApplication();
        // @todo refactor
        if(isset($parsed['path'])) {
            //
            $alias = $application->getAliases()[$application['prefix'] . $parsed['path']];
            if(!$alias) {
                throw new ClassNotFoundException("Not Found [{$parsed['path']}] command");
            }
            // query parse
            if(isset($parsed['query'])) {
                parse_str($parsed['query'], $query);
            }

            $class = $this->container->make($alias);
            $start = microtime(true);
            $class->init();
            $class->action($query);
            /** @var  $end */
            $end = microtime(true);
            $process = sprintf('%0.5f', ($end - $start));
            if($displayTime) {
                $output->writeln("<info>{$process}</info><comment>/second</comment>");
            }
        }
    }
}