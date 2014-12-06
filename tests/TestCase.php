<?php

class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @param \Iono\Console\Container $container
     */
    protected function setConfigure(\Iono\Console\Container $container)
    {
        $container['prefix'] = "iono.command.";
        $container['directory'] = require TEST_DIR ."/tests/path.php";
        $container->bindShared('component.config', function () use($container) {
                return \Iono\Console\Application\Configure::registerConfigure($container);
            }
        );
    }

    /**
     * @param $class
     * @param $name
     * @return \ReflectionMethod
     */
    protected function getProtectMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @param $class
     * @param $name
     * @return \ReflectionProperty
     */
    protected function getProtectProperty($class, $name)
    {
        $class = new \ReflectionClass($class);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }
} 