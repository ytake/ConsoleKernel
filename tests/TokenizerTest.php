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
}

class TestClass
{
    public $publicProperty = 1;

    protected $protectedProperty = 1;

    private $privateProperty = 1;
}