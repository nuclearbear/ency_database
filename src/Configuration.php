<?php

namespace Nuclearbear\Encydb;

class Configuration
{
    protected $configurationFolder = "conf/";
    protected $configurationFiles = [];

    public function __constructor($configurationFile = "", $servicesFile = "", $additionalFile = "")
    {
        foreach ($argc as $key => $argumentName) {
            if (${$argumentName} !== "") {
                $this->loadConfigurationFile($argumentName);
            }
        }
    }

    private function loadConfigurationFile(string $file)
    {
        $config = file_get_contents($this->configurationFolder . $file . ".conf");

        throw new Exception($config, "200");
    }
}