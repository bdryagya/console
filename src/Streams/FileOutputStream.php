<?php

namespace Bakhari\Console\Streams;

use Bakhari\Console\Contracts\OutputStream as OutputStreamContract;

class FileOutputStream implements OutputStreamContract
{
    /**
     * File to log the output
     * 
     * @var string
     */
    protected $file;

    /**
     * Create the FileOutputStream Instance.
     *
     * @param   \Illuminate\Contract\Config $config
     *
     * @return  void
     */
    public function __construct($file = "")
    {
        $this->file = $file;
    }

    /**
     * Write output data to the file
     */
    public function write($chunk)
    {
        return file_put_contents($this->file, $chunk, FILE_APPEND);
    }
}
