<?php

require_once "vendor/autoload.php";

$config = Config::init();
$envConfig = Config::replaceEnvConf($config);

Route::init();
$encyDatabase = new Application($argv);
