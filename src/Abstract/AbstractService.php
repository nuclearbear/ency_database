<?php

namespace Nuclearbear\Encydb\Abstract;

abstract class AbstractService
{
    protected $config;
    protected $savedData;

    abstract public function __construct();
}