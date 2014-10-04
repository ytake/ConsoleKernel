<?php
namespace Iono\Console\app;

use Iono\Console\Application;

/**
 * Class Sample
 * @package Iono\Console\app
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Sample extends Application
{

    use Application\Component;

    /** @var string  */
    protected $command = 'sample';

    /** @var  string */
    protected $description = "sample application";

    /**
     * @param Stub $stub
     */
    public function __construct(Stub $stub)
    {
        $this->stub = $stub;
    }

    /**s
     * @param array $array
     * @return mixed|void
     */
    public function action(array $array)
    {
        var_dump($this->component);
        var_dump($this->stub->get());
        //var_dump($this->component);
    }
}