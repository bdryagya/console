<?php

namespace Bakhari\Console;

use Illuminate\Support\Arr;
use Bakhari\Console\Contracts\ReturnContract;

class ReturnClass implements ReturnContract
{

    /**
     * The return class repository.
     *
     * @var array
     */
    protected $repository = [];

    /**
     * Return status of the callee method.
     * Must return 0 on successive call, other value can anyting
     * in beetween 0 to 255
     *
     * @var int
     *
     * protected $statusCode = 0;
     */

    /**
     * The return value
     *
     * protected $body = null;
     *
     * @var mixed
     */

    /**
     * The error code
     *
     * protected $errno = 0;
     *
     * @var int
     */

    /**
     * The error message
     *
     * protected $error = null;
     *
     * @var string
     */

    /**
     * Create the ReturnClass instance.
     *
     * @param   array   $config
     *
     * @return  void
     */
    public function __construct(array $return)
    {
        $this->repository = $return;
    }

    /**
     * Return status of the callee method.
     * Must return 0 on successive call, other value can anyting
     * in beetween 0 to 255
     *
     * @return  int
     */
    public function getStatusCode()
    {
        return Arr::get($this->repository, 'statusCode', null);
    }

    /**
     * Return content of callee method
     *
     * @return  mixed
     */
    public function getBody()
    {
        return Arr::get($this->repository, 'body', null);
    }

    /**
     * Error number if error occured
     *
     * @return  int
     */
    public function getErrno()
    {
        return Arr::get($this->repository, 'errno', null);
    }

    /**
     * Error message
     *
     * @return  string
     */
    public function getErrorMessage()
    {
        return Arr::get($this->repository, 'error', null);
    }
}
