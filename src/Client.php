<?php

namespace Pronamic\Twinfield;

class Client
{
    const WSDL_URL_LOGIN = 'https://login.twinfield.com/webservices/session.asmx?wsdl';

    const WSDL_URL_SESSION = '%s/webservices/session.asmx?wsdl';

    public function __construct()
    {
        $this->soapClient = new \SoapClient(self::WSDL_URL_LOGIN, array('trace' => 1));
    }

    public function getSession(Credentials $credentials)
    {
        $session = null;

        $response = $this->soapClient->Logon($credentials);

        // Check response is successful
        if (LogonResult::OK == $response->LogonResult) {
            // Response from the logon request
            $this->loginResponse = $this->soapClient->__getLastResponse();

            // Make a new DOM and load the response XML
            $envelope = new \DOMDocument();
            $envelope->loadXML($this->loginResponse);

            // Gets SessionID
            $sessionIdElement = $envelope->getElementsByTagName('SessionID');
            $sessionId = $sessionIdElement->item(0)->textContent;

            // Gets Cluster URL
            $clusterElement = $envelope->getElementsByTagName('cluster');
            $cluster = $clusterElement->item(0)->textContent;

            $session = new Session($sessionId, $cluster);
        }

        return $session;
    }
}
