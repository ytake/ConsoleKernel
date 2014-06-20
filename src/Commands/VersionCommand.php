<?php
namespace Iono\Console\Commands;

use Iono\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class VersionCommand
 * @package Iono\Console\Commands
 * @author  yuuki.takezawa<yuuki.takezawa@excite.jp>
 */
class VersionCommand extends Command
{

    const COMMAND_NAME = "consoler:version";

    const VERSION = '0.2.1-alpha';

    /**
     * @return mixed|void
     */
    public function argument()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Display this comnect/console version')
            ->addArgument('consoler:version');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
     */
    public function action(InputInterface $input, OutputInterface $output)
    {
        $text = "comnect/console <info>" .self::VERSION . "</info>";
        $output->writeln($text);
    }
}