<?php
namespace Iono\Console;

use Colors\Color;
use ReflectionClass;
use TokenReflection\Broker;

/**
 * Class Tokenizer
 * @package Iono\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Tokenizer
{

    /** @var string  */
    protected $parentClass = "Iono\\Console\\Application";

    /** @var \TokenReflection\Broker  */
    protected $broker;

    /** @var \Colors\Color  */
    protected $color;

    /** @var \Iono\Console\Container  */
    protected $container;

    /**
     * @param Container $container
     * @param Color $color
     */
    public function __construct(Container $container, Color $color)
    {
        $this->broker = new Broker(new Broker\Backend\Memory());
        $this->color = $color;
        $this->container = $container;
    }

    /**
     * get application commands
     * @return Container
     */
    public function getApplication()
    {
        $this->broker->processDirectory($this->container['path']);
        $classes = $this->broker->getClasses();

        foreach($classes as $class) {

            if($this->parentClass === $class->getParentClassName()) {

                $commandValue = $this->getProperty($class->getName(), 'command');
                // command name not found
                if(is_null($commandValue)) {
                    $color = $this->color;
                    echo $color("Command name can not be found {$class->getName()}")
                            ->white->bold->bg_magenta . PHP_EOL;
                }
                if($commandValue) {
                    $this->container->alias($class->getName(), "{$this->container['prefix']}{$commandValue}");
                }
            }
        }
        return $this->container;
    }


    /**
     * @param $class
     * @param string $command
     * @return mixed
     */
    public function getProperty($class, $command = null)
    {
        if(!is_null($command)) {
            $reflectionClass = new ReflectionClass($class);
            $instance = $reflectionClass->newInstanceWithoutConstructor();
            $reflectionPropertyCommand = $reflectionClass->getProperty($command);
            $reflectionPropertyCommand->setAccessible(true);
            return $reflectionPropertyCommand->getValue($instance);
        }
        return null;
    }


    public function binder()
    {
        // @todo
    }
}