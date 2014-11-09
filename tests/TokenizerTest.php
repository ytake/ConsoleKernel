<?php

/**
 * Class TokenizerTest
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class TokenizerTest extends \PHPUnit_Framework_TestCase
{

    /** @var Iono\Console\Tokenizer */
    protected $tokenizer;

    public function setUp()
    {
        parent::setUp();
        $container = new \Iono\Console\Container();
        $this->setConfigure($container);
        $this->tokenizer = new \Iono\Console\Tokenizer(
            $container, new \Colors\Color()
        );
    }

    public function testInstance()
    {
        $this->assertInstanceOf("Iono\Console\Tokenizer", $this->tokenizer);
    }

    public function testProperty()
    {
        $this->assertNull($this->tokenizer->getProperty($this));
        $this->assertSame(1, $this->tokenizer->getProperty("TestClass", "publicProperty"));
        $this->assertSame(1, $this->tokenizer->getProperty("TestClass", "protectedProperty"));
        $this->assertSame(1, $this->tokenizer->getProperty("TestClass", "privateProperty"));
    }

    public function testApplication()
    {
        $this->assertInstanceOf("Iono\Console\Container", $this->tokenizer->getApplication());
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

class TestClass
{
    public $publicProperty = 1;

    protected $protectedProperty = 1;

    private $privateProperty = 1;
}