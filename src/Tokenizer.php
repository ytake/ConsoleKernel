<?php
namespace Iono\Console;

use Colors\Color;
use ReflectionClass;
use TokenReflection\Broker;
use Illuminate\Container\Container;

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

    /** @var \Illuminate\Container\Container  */
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

                $className = $class->getName();
                $reflectionClass = new ReflectionClass($class->getName());
                $reflectionPropertyCommand = $reflectionClass->getProperty('command');
                $reflectionPropertyCommand->setAccessible(true);

                $name = $reflectionPropertyCommand->getValue(new $className);
                // command name not found
                if(is_null($name)) {
                    $color = $this->color;
                    echo $color("Command name can not be found {$className}")
                            ->white->bold->bg_magenta . PHP_EOL;
                }
                if($name) {
                    $this->container->bind("iono.command.{$name}", $className);
                }
            }
        }
        return $this->container;
    }
}