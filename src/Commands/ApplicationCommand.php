<?php
namespace Iono\Console\Commands;

use Iono\Console\Command;
use Iono\Console\Exception\ClassNotFoundException;
use Iono\Console\Tokenizer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ApplicationCommand
 * @package Iono\Console\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ApplicationCommand extends Command
{

    /** @var string  */
    protected $command = "console:app";

    /** @var string */
    protected $description = "application scripts";

    /** @var Tokenizer */
    protected $tokenizer;

    /**
     * @param Tokenizer $tokenizer
     */
    public function __construct(Tokenizer $tokenizer)
    {
        parent::__construct();
        $this->tokenizer = $tokenizer;
    }

    /**
     * @return mixed|void
     */
    public function arguments()
    {
        $this->addArgument('action', InputArgument::REQUIRED, 'specify your script name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
     * @throws \Iono\Console\Exception\ClassNotFoundException
     */
    public function action(InputInterface $input, OutputInterface $output)
    {
        //
        $query = [];
        //
        $parsed = parse_url($input->getArgument('action'));
        // search application
        $application = $this->tokenizer->getApplication();
        //
        if(isset($parsed['path'])) {
            //
            if(!$application->offsetExists($parsed['path'])) {
                throw new ClassNotFoundException("Not Found [{$parsed['path']}] command");
            }
            // query parse
            if(isset($parsed['query'])) {
                parse_str($parsed['query'], $query);
            }
            $command = $application['prefix'] . $parsed['path'];
            $application->make($command)->perform($query);
        }

    }
}
