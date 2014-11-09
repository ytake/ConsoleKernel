<?php
namespace Iono\TestConsole\app;

/**
 * Class ComponentTest
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class ComponentTest extends \Iono\Console\Application
{

    use \Iono\Console\Application\Traits\Component;

    /** @var  string */
    protected $command = "testing";

    /** @var  string */
    protected $description = "testing";

    public function __construct(\stdClass $class, $string = "test")
    {

    }

    /**
     * @param array $array
     * @return mixed
     */
    function action(array $array)
    {
        // TODO: Implement action() method.
    }
}
