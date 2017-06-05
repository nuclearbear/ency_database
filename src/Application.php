<?php

namespace Nuclearbear\Encydb;

use Nuclearbear\Encydb\Encryption\Auth;
use Nuclearbear\Encydb\Configuration;

class Application
{
    protected $argv;
    protected $auth;
    protected $configuration;

    public function __constructed(Array $parameters, Auth $auth)
    {
        $this->argv = $parameters;
        $this->auth = $auth;
        $this->authKeys = $auth::initKeys();
        $this->configuration = new Configuration();
    }

    private function moveStateOn()
    {
        $transferSecurityCheck = $auth::transferCheck();

        if ($transferSecurityCheck === false) {
            throw new Exception("Keys transfering wasn't secured. Please check logs file and instruction to fix it.", 403);
        }
    }
    
    private function moveStateOff()
    {
        $this->clearCache();
        $this->clearConnection();
        $this->clearAuth();
    }

    public function run()
    {
        $this->moveStateOn();


        $this->moveStateOff();
    }
}