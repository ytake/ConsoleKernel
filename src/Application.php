<?php
namespace Iono\Console;

/**
 * Class Application
 * @package Iono\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
abstract class Application implements ApplicationInterface
{

    /** @var  string */
    protected $command;

    /**
     * @param array $array
     * @return mixed
     */
    abstract function perform(array $array);

}