<?php
namespace Iono\Console\app;

class Stub
{

    public function __construct(SampleStub $sampler)
    {

    }

    /**
     * @return array
     */
    public function get()
    {
        return [1, 2, 3, 4];
    }
} 