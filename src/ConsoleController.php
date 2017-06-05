<?php

namespace Nuclearbear\Encydb;

class ConsoleController
{
    protected $tempFolder = '/temp/';

    /**
     * CommandList contains list of commands as keys of array and 
     * as value it contains the array of functions to run 
    **/

    protected $commandsList = [
        'install'  => ['Nuclearbear/Encydb/Commands', 'parameters'],
        'update'   => ['Nuclearbear/Encydb/Commands', 'updateGoal'],
        'remove'   => ['Nuclearbear/Encydb/Commands', 'afterUninstall']
    ];

    /**
     * Options saved while run CLI
    **/

    protected $options = [];

    public function beforeAction()
    {

    }

    public function afterAction()
    {

    }

    public function runAction(string $action, Array $options)
    {
        try {
            call_user_func($this->commandsList[$action][0], $action, $options);
        } catch (Exception $errorInstance) {
            $this->errorHandle($errorInstance);
        }
    }

    protected function errorHandle(Exception $e)
    {
        $this->printLine($e->getMessage());
        $this->logError($e, $e->getMessage());
    }

    protected function printLine(string $string)
    {
        echo date("H:i:s") . " " . $string . "\n";
    }

    protected function logError(Exception $err, string $msg) 
    {
        $errorLog = fopen($this->$tempFolder . 'exceptions.log', 'a+');
        fwrite($errorLog, date("H:i:s") . " " . $msg ".\n" . "StackTrace:\n" . $err->getStackTrace());
        fclose($errorLog);

        return;
    }
}