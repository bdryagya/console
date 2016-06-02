<?php

namespace Bakhari\Console;

use Bakhari\Console\Contracts\Command as CommandContract;

class Command implements CommandContract
{
    /**
     * Console commands.
     *
     * @var array
     */
    protected $list = [];

    /**
     * Command execution current position
     *
     * @var int
     */
    protected $position = 0;

    /**
     * Create a new Command instance.
     * 
     * @var array|string    $command
     *
     * @return  array|string
     */
    public function __construct($config)
    {
        $this->list = $config;
    }

    /**
     * Fetch command one by one.
     *
     * @return  string
     */
    public function fetch()
    {
        if(!array_key_exists($this->position, $this->list)) {
            return false;
        }

        $current = $this->list[$this->position];

        $this->position ++;

        return $current;
    }

    /**
     * Fetch command list.
     *
     * @return  array.
     */
    public function all()
    {
        return $this->list;
    }
}
