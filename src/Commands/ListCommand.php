<?php
namespace Iono\Console\Commands;

use ReflectionClass;
use Iono\Console\Command;
use Iono\Console\Tokenizer;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ListCommand
 * @package Iono\Console\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ListCommand extends Command
{

    /** @var string  */
    protected $command = "console:list";

    /** @var string  */
    protected $description = 'application list';

    /** @var Tokenizer */
    protected $tokenizer;

    /** @var array  */
    protected $header = ["Command Name", "Class", "filePath"];

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

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
     */
    public function action(InputInterface $input, OutputInterface $output)
    {
        // application container
        $application = $this->tokenizer->getApplication();

        // get bindings
        $bindings = $application->getBindings();
        $row = [];
        $message = "<comment>Command Line Application is not implemented!</comment>";
        /**  */
        if(count($bindings)) {

            foreach($bindings as $key => $bind) {

                if(preg_match("/^{$application['prefix']}/", $key)) {

                    $class = get_class($application->offsetGet($key));
                    $reflectionClass = new ReflectionClass($class);
                    $row[] = [
                        str_replace("{$application['prefix']}", "", $key),
                        $class,
                        $reflectionClass->getFileName()
                    ];
                    $message = "";
                }
            }

        }
        // table render
        $table = new Table($output);
        $table->setHeaders($this->header)->setRows($row);
        $table->render();
        $output->writeln($message);
    }
}
