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

    use Application\Traits\Component;

    /** @var string  */
    protected $command = 'sample';

    /** @var  string */
    protected $description = "sample application";

    /**s
     * @param array $array
     * @return mixed|void
     */
    public function action(array $array)
    {
        $statement = $this->db->connection();
    }
}