<?php

namespace Bakhari\Console\Contracts;

interface ReturnContract
{
    /**
     * Create the ReturnContract instance.
     *
     * @param   array   $config
     *
     * @return  void
     */
    public function __construct(array $config);

    /**
     * Return status of the callee method.
     * Must return 0 on successive call, other value can anyting
     * in beetween 0 to 255
     *
     * @return  int
     */
    public function getStatusCode();

    /**
     * Return body of callee method
     *
     * @return  mixed
     */
    public function getBody();

    /**
     * Error number if error occured
     *
     * @return  int
     */
    public function getErrno();

    /**
     * Error message
     *
     * @return  string
     */
    public function getErrorMessage();
}
