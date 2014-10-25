<?php
namespace Iono\Console;

use Closure;
use ReflectionClass;
use Illuminate\Container\BindingResolutionException;

/**
 * Class Container
 * @package Iono\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Container extends \Illuminate\Container\Container
{

    /** @var string  */
    protected $componentTrait = "Iono\\Console\\Application\\Traits\\Component";

    /**
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * @param string $concrete
     * @param array $parameters
     * @return mixed|object
     * @throws BindingResolutionException
     */
    public function build($concrete, $parameters = [])
    {

        if ($concrete instanceof Closure) {
            return $concrete($this, $parameters);
        }
        $reflector = new ReflectionClass($concrete);

        if(!$reflector->isInstantiable()) {
            $message = "Target [$concrete] is not instantiable.";
            throw new BindingResolutionException($message);
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {

            return $reflector->newInstance();
        }
        $dependencies = $constructor->getParameters();

        $parameters = $this->keyParametersByArgument(
            $dependencies, $parameters
        );

        $instances = $this->getDependencies(
            $dependencies, $parameters
        );
        return $reflector->newInstanceArgs($instances);
    }

    /**
     * Fire all of the resolving callbacks.
     * & inject iono/component trait class
     * @param  string  $abstract
     * @param  mixed   $object
     * @return void
     */
    protected function fireResolvingCallbacks($abstract, $object)
    {
        if (isset($this->resolvingCallbacks[$abstract])) {
            $this->fireCallbackArray($object, $this->resolvingCallbacks[$abstract]);
        }

        if (is_object($object)) {
            foreach (class_uses($object) as $trait) {
                if ($trait === $this->componentTrait) {
                    call_user_func_array([$object, 'setComponent'], [$this->injectTraits(), $this]);
                }
            }
        }
        $this->fireCallbackArray($object, $this->globalResolvingCallbacks);
    }

    /**
     * @access private
     * @return object
     */
    private function injectTraits()
    {
        $bindings = $this->getBindings();
        foreach($bindings as $key => $bind) {
            if(strstr($key, 'component.')) {
                $array[str_replace('component.', "", $key)] = $key;
            }
        }
        /** @var \Illuminate\Config\Repository $config */
        $config = $this->make($array['config']);
        $array = array_merge($array, $config->get('component'));
        return (object) $array;
    }

}