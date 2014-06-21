<?php
/**
 * Class TokenizerTest
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class TokenizerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Iono\Console\Tokenizer */
    protected $token;

    public function setUp()
    {
        $this->token = new \Iono\Console\Tokenizer(
            new Illuminate\Container\Container, new \Colors\Color
        );
    }

    public function testTokenInstance()
    {
        $this->assertInstanceOf('Iono\Console\Tokenizer', $this->token);
    }

    public function testScanApplication()
    {
        $stub = $this->getMock('path');
        $stub->expects($this->any())->will($this->returnValue(__DIR__ . "/src"));


        //var_dump($this->token->getApplication());
        //$stubBroker = $this->getMock("TokenReflection\Broker");

    }

}