<?php

namespace Bakhari\Console;

class Output
{
    /**
     * Exit status
     *
     * @var int
     */
    protected $statusCode;

    /**
     * Output content
     *
     * @var array
     */
    protected $body = [];

    /**
     * Set status
     *
     * @param   int $status
     *
     * @return  void
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Get command exit status
     *
     * @return  int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Push output data to body
     *
     * @param   mixed
     *
     * @return  bool
     */
    public function push($body)
    {
        return array_push($this->body, $body);
    }

    /**
     * Get output body
     *
     * @return  mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Flush output body
     *
     * @return  void
     */
    public function flush()
    {
        $this->body = [];
    }
}
