<?php
namespace Iono\Console\Commands;

use ErrorException;
use Iono\Console\Command;
use Iono\Console\Container;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratorCommand
 * @package Iono\Console\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class GeneratorCommand extends Command
{

    /** @var string  */
    protected $command = "app:create";

    /** @var string  */
    protected $description = 'create application class';

    /** @var Container  */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    /**
     * @return mixed|void
     */
    public function arguments()
    {
        $this->addOption('class', 'c', InputOption::VALUE_REQUIRED, 'generate class name');
        $this->addOption('path', 'p', InputOption::VALUE_OPTIONAL, 'generate directory path');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
     */
    public function action(InputInterface $input, OutputInterface $output)
    {
        $className = ucfirst(mb_strtolower($input->getOption('class')));
        $namespace = $this->container['component.config']->get('config')['namespace'];
        $defaultPath = $this->container['directory']['application.path'];

        $stubCommand = file_get_contents(__DIR__ . '/Stub/command.stub');
        $stubCommand = str_replace('{{command}}', mb_strtolower($className), $stubCommand);
        $stubCommand = str_replace('{{class}}', $className, $stubCommand);
        $contents = str_replace('{{namespace}}', ucfirst(mb_strtolower($namespace)), $stubCommand);

        $path = (is_null($input->getOption('path'))) ? $defaultPath : $input->getOption('path');
        $this->putCommandFile($path, $contents, $className);

        $output->writeln("<comment>successfully generated</comment>  <info>{$path}/{$className}.php</info>");
    }


    /**
     * @param $path
     * @param $contents
     * @param $fileName
     * @throws ErrorException
     * @throws \Exception
     */
    protected function putCommandFile($path, $contents, $fileName)
    {
        set_error_handler(function ($errorNumber, $errorMessage, $errorFile, $errorLine) {
                throw new ErrorException($errorMessage, 0, $errorNumber, $errorFile, $errorLine);
            }
        );
        try {
            if(!is_dir($path)) {
                mkdir($path, 0755);
                $this->putCommandFile($path, $contents, $fileName);
            }
            if(file_exists($path . "/{$fileName}.php")) {
                throw new ErrorException("file already exists.");
            }
            file_put_contents($path . "/{$fileName}.php", $contents);
        } catch (ErrorException $e) {
            throw $e;
        }
    }
}
