<?php
namespace Iono\TestConsole\Application\Command;

class ApplicationCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Iono\Console\Commands\ApplicationCommand */
    protected $command;

    public function setUp()
    {
        parent::setUp();
        $container = new \Iono\Console\Container;
        $this->setConfigure($container);

        // file scan
        $tokenizer = new \Iono\Console\Tokenizer(
            $container, new \Colors\Color()
        );
        $this->command = new \Iono\Console\Commands\ApplicationCommand(
            $tokenizer, $container
        );
    }

    public function testInstance()
    {
        $this->assertInstanceOf("Iono\Console\Commands\ApplicationCommand", $this->command);
    }

    public function testCleanCommand()
    {
        $this->command->run(
            new \Symfony\Component\Console\Input\ArrayInput(
                [
                    'action' => "testing"
                ]
            ),
            new \Symfony\Component\Console\Output\NullOutput
        );

    }

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
} 