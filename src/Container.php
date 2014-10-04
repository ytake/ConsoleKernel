<?php
namespace Iono\Console;

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
                if (trait_exists($trait)) {
                    $array = [
                        'db' => ''
                    ];
                    call_user_func([$object, 'setComponent'], (object) $array);
                }
            }
        }
        $this->fireCallbackArray($object, $this->globalResolvingCallbacks);
    }
}