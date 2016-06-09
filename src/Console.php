<?php

namespace Bakhari\Console;

use Closure;

use PhanAn\Remote\Remote;

use Bakhari\Console\Output;
use Bakhari\Console\ReturnClass;
use Bakhari\Console\Contracts\Command;
use Bakhari\Console\Streams\FileOutputStream;
use Bakhari\Console\Streams\StandardOutputStream;
use Bakhari\Console\Streams\Manager as StreamManager;
use Bakhari\Console\Contracts\Console as ConsoleInterface;
use Bakhari\Console\Contracts\OutputStream as OutputStreamContract;

use Illuminate\Contracts\Config\Repository as Config;

class Console implements ConsoleInterface
{
    /**
     * Remote Console.
     *
     * @var \PhanAn\Remote\Remote 
     */
    protected $cli;

    /**
     * The config repository
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Console prompt
     *
     * @var regex string
     */
    protected $prompt;

    /**
     * Output of the console
     *
     * @var \Bakhari\Console\CLI\Output
     */
    protected $output;

    /**
     * List of connected output streams
     *
     * @var array
     */
    protected $outputStreams = [];

    /**
     * Create a new Console instance.
     *
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->prompt = $config->get('prompt', '/[\$#>]/');

        $this->output = new Output;

        $this->setStreamManager(new StreamManager);

        // Setup the Standard Output Stream
        if($this->config->get('stdout', true)) {

            $this->pushOutputStream(new StandardOutputStream);
        }

        // Setup the File Output Stream
        if($this->config->get('fileout', false)) {

            $this->pushOutputStream(new FileOutputStream($this->config->get('fileout')));
        }

        // Setup Command Line Interface
        $this->cli = new Remote($this->config->all(), $this->config->get('auto_login'));
    }

    /**
     * Login to console.
     *
     * @return  void;
     */
    public function login()
    {
        return $this->cli->login();
    }

    /**
     * Run commands.
     *
     * @param   \Bakhari\Console\CLI\Command   $command
     * @param   bool    $dry_run
     */
    public function run(Command $command, $dry_run = false, $wait = 0)
    {

        if($dry_run) {

            // We'll just send output to streams without executing
            while($cmd = $command->fetch()) {

                // read regex 1 -> plain text
                // read regex 2 -> pcre
                $read_regex = 1;

                usleep($wait);

                if(isset($cmd['regex']) && $cmd['regex']){
                    $read_regex = 2;
                }

                $this->output->push($cmd['write'] . ' => ' . "($read_regex) " . $cmd['read'] );

                $this->getStreamManager()->writeAll($cmd['write'] .  ' => ' . "($read_regex) " . $cmd['read'] . "\n");
            }

        } else {

            while($cmd = $command->fetch()) {

                // read regex 1 -> plain text
                // read regex 2 -> PCRE 
                $read_regex = 1;

                if(isset($cmd['regex']) && $cmd['regex']){
                    $read_regex = 2;
                }

                usleep($wait);

                // $this->cli->write($cmd . "\n");
                $this->cli->write($cmd['write'] . "\n");

                $this->cli->setTimeout(15);

                // check if the read is a pcre
                $read = $this->cli->read($cmd['read'], $read_regex);

                $this->output->push($read);
                
                $this->getStreamManager()->writeAll($read);
            }

        }

        $this->output->setStatusCode(0);
        
        return new ReturnClass([
            'status_code'   => $this->output->getStatusCode(),
            'body'          => $this->output->getBody(),
        ]);
    }

    /**
     * Get The Output Interface
     *
     * @return  \Bakhari\Console\CLI\OutputInterface
     */
    public function getOutputStream()
    {
        return $this->outputStreams;
    }

    /**
     * Set The Output Interface
     *
     * @return  \Bakhari\Console\CLI\OutputInterface
     */
    public function pushOutputStream(OutputStreamContract $outputStream)
    {
        return $this->getStreamManager()->pushOutputStream($outputStream);
    }

    /**
     * Set the Command Line Interface to interfact to the host.
     *
     * @param   \PhanAn\Remote\Remote
     */
    public function setCLI(Remote $remote)
    {
        $this->cli = $remote;
    }

    /**
     * Get config item
     *
     * @param   string  $item
     *
     * @return  mixed
     */
    public function getConfig()
    {
        return $this->config->all();
    }

    /**
     * Get StreamManager
     *
     * @return  \Bakhari\Console\Streams\StreamManager
     */
    public function getStreamManager()
    {
        return $this->streamManager;
    }

    /**
     * Set StreamManager
     *
     * @param   \Bhakhari\Console\Streams\StreamManager
     *
     * @return  void
     */
    public function setStreamManager(StreamManager $streamManager)
    {
        return $this->streamManager = $streamManager;
    }
}
