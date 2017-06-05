<?php

namespace Nuclearbear\Encydb;

class ServiceManager
{
    private static $instanceOf;

    protected $services;

    public static function getInstance(Configuration $conf)
    {
        if (is_object(self::$instanceOf) && is_a(self::$instanceOf, "ServiceManager")) {
            return self::instanceOf;
        }

        self::$instanceOf = new ServiceManager($conf);
    }

    protected function __construct(Configuration $conf)
    {
        $this->services = new Collection();
        $this->services->load($conf->loadServiceList());
    }

    public function addService(AbstractService $service)
    {
        $this->services->add($service);
    }

    public function removeService(string $className)
    {
        $this->services->remove($className);
    }

    public function getServices()
    {
        $this->services;
    }

    public function getService(string $className)
    {
        $requestedService = $this->services->find($className);

        return $requestedService;
    }
}