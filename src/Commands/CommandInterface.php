<?php
namespace Iono\Console\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface CommandInterface
 * @package Iono\Console\Commands
 * @author  yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
interface CommandInterface
{

    /**
     * @return mixed
     */
    public function arguments();

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function action(InputInterface $input, OutputInterface $output);
}