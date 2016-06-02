<?php

namespace Bakhari\Console\Streams;

use Bakhari\Console\Contracts\OutputStream as OutputStreamContract;

class Manager
{
    /**
     * All the output streams.
     *
     * var  @array
     */
    protected $streams = [];

    /**
     * Create the Manager instance.
     *
     * @param   array   $streams
     *
     * @return  void
     */
    public function __construct(array $streams = [])
    {
        $this->streams = $streams;
    }

    /**
     * Add output stream
     *
     * @param   Bakhari\Console\Contracts\OutputStream
     *
     * @return  void
     */
    public function pushOutputStream(OutputStreamContract $outputStream)
    {
        return array_push($this->streams, $outputStream);
    }

    /**
     * Write data to all the connected streams
     *
     * @param   string|mixed    $chunk
     *
     * @return  void
     */
    public function writeAll(string $chunk)
    {
        foreach($this->streams as $stream) {
            $stream->write($chunk);
        }
    }
}
