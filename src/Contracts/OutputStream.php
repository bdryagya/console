<?php

namespace Bakhari\Console\Contracts;

interface OutputStream
{
    public function write(string $chunk);
}
