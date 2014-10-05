<?php
namespace Iono\Console\app;

use Iono\Console\Application\Traits\Component;

class Stub
{

    use Component;

    /**
     * @return array
     */
    public function get()
    {
        var_dump($this->component);
        return [1, 2, 3, 4];
    }
} 