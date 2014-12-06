<?php
namespace Iono\TestConsole\Application\Command;

use Symfony\Component\Console\Tester\CommandTester;

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
        /** @var \Symfony\Component\Console\Tester\CommandTester $command */
        $command = new CommandTester($this->command);
        $command->execute(['action' => "testing"]);
        $this->assertEquals('', $command->getDisplay());

        $command = new CommandTester($this->command);
        $command->execute(['action' => "testing", '--time' => true]);
        $this->assertNotEquals('', $command->getDisplay());
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