<?php

namespace Pronamic\Twinfield;

class Finder
{
    public $sessionId;

    public function __construct($sessionId, $cluster)
    {
        $this->sessionId = $sessionId;
        $this->cluster = $cluster;

        $this->client = new \SoapClient($this->getWsdlUrl(), array(
            'classmap' => $this->getClassMap(),
        ));
        $this->client->__setSoapHeaders($this->getSoapHeader());
    }

    private function getWsdlUrl()
    {
        return sprintf(Client::WSDL_URL_FINDER, $this->cluster);
    }

    private function getSoapHeader()
    {
        return new \SoapHeader('http://www.twinfield.com/', 'Header', array('SessionID' => $this->getId()));
    }

    private function getClassMap()
    {
        return array(
            'SearchResponse' => 'Pronamic\Twinfield\SearchResponse',
            'FinderData' => 'Pronamic\Twinfield\FinderData',
        );
    }

    public function getId()
    {
        return $this->sessionId;
    }

    public function getCluster()
    {
        return $this->cluster;
    }

    public function search( Search $search )
    {
        $response = $this->client->Search($search);

        return $response;
    }
}
