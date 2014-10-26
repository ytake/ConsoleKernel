<?php
namespace Iono\Console\Exception;

/**
 * Class ClassNotFoundException
 * @package Iono\Console\Exceptions
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class ClassNotFoundException extends \Exception
{

    /**  */
    const NOT_IMPLEMENTED = 501;

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = self::NOT_IMPLEMENTED)
    {
        parent::__construct($message, $code);
    }

}