<?php

namespace Bakhari\Console\Streams;

use Bakhari\Console\Contracts\OutputStream as OutputStreamContract;

class StandardOutputStream implements OutputStreamContract
{
    /**
     * Write output data to stdout
     * 
     * @var string
     */
    public function write($chunk)
    {
        echo $chunk;
    }
}
