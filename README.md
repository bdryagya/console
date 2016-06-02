# Console (SSH)

Execute command to remote host using SSH Channel.
#### Import Classes
```php
require_once __DIR__ . "/vendor/autoload.php";

use Bakhari\Console\Console;
use Bakhari\Console\Command;
use Bakhari\Console\Streams\FileOutputStream;

use PhanAn\Remote\Remote;
use Illuminate\Config\Repository as ConsoleConfig;
```

#### Set up a new Console
```php
$console = new Console(new ConsoleConfig([
    'host'          => '127.0.0.1',
    'port'          => 22,
    'username'      => '<username>',
    'password'      => base64_decode('PHBhc3N3b3JkPg=='),
    'auto_login'    => false,
    'prompt'        => '/[\$>]/',
    'stdout'        => false,
]));
```

Console's output is sent to stdout by default. Other streams can be added as well.
Below we are using FileOutputStream to log the output to /tmp/console
```php
$console->pushOutputStream(new FileOutputStream('/tmp/console'));
````

#### Login to Console
If auto_login is disabled, we need to login
```php
$console->login();
```

To run commands we create a Command Object, and envoke it using run method. Second optional parameter (bool)$dry can be passed for dummy test.

```php
$console->run(new Command([
    'hostname',
    'cat /etc/passwd',
]));
```
