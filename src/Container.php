<?php
namespace Iono\Console;

use ReflectionClass;

/**
 * Class Container
 * @package Iono\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Container extends \Illuminate\Container\Container
{

    /**
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }


    protected function getDependencies($parameters, array $primitives = array())
    {
        $dependencies = array();

        foreach ($parameters as $parameter) {

            $dependency = $parameter->getClass();
            // get traits
            $this->traitInject($dependency);

            if (array_key_exists($parameter->name, $primitives)) {

                $dependencies[] = $primitives[$parameter->name];

            } elseif (is_null($dependency)) {

                $dependencies[] = $this->resolveNonClass($parameter);

            } else {

                $dependencies[] = $this->resolveClass($parameter);
            }
        }

        return (array) $dependencies;
    }


    protected function traitInject(ReflectionClass $class)
    {

        if(class_uses($class->name)) {

            foreach(class_uses($class->name) as $trait) {

                if(trait_exists($trait)) {
                    $reflector = new ReflectionClass($class->name);
                    $reflectorMethod = $reflector->getMethod('setComponent');
                    $array = [
                        'db' => ''
                    ];
                    var_dump($reflectorMethod->invoke(new $class->name, (object)$array));
                }
            }

        }
    }
}