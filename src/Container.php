<?php
namespace Iono\Console;

/**
 * Class Container
 * @package Iono\Console
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
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