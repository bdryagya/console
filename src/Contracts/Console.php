<?php

namespace Bakhari\Console\Contracts;

use Bakhari\Console\Contracts\Command;
use Bakhari\Console\CLI\OutputInterface;

interface Console
{
    /**
     * Run commands.
     *
     * @param   \Bakhari\Console\CLI\Command   $command
     * @param   bool    $dry_run
     */
    public function run(Command $command, $dry_run = false);
}
