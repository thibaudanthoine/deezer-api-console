<?php

namespace Thibaud\Console;

use Symfony\Component\Console\Application;
use Thibaud\Console\Command;

class DeezerApp extends Application
{
    public function __construct()
    {
        parent::__construct('Welcome to Deezer CLI Application', '1.0');
 
        $this->addCommands(array(
            new Command\DeezerSearchCommand()
        ));
    }
}