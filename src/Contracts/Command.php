<?php

namespace Bakhari\Console\Contracts;

interface Command
{
    /**
     * Create a new Command instance.
     * 
     * @var array|string    $command
     *
     * @return  array|string
     */
    public function __construct($config);

    /**
     * Fetch command one by one.
     * 
     * Fetch current command to execute from list.
     *
     * @return  string
     */
    public function fetch();

    /**
     * Fetch command list.
     *
     * @return  array.
     */
    public function all();
}
