<?php

namespace Pronamic\Twinfield;

class LogonResponse
{
    private $LogonResult;

    private $nextAction;

    private $cluster;

    public function getNextAction()
    {
        return $this->nextAction;
    }

    public function getResult()
    {
        return $this->LogonResult;
    }

    public function getCluster()
    {
        return $this->cluster;
    }
}
