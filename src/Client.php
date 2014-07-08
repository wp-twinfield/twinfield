<?php

namespace Pronamic\Twinfield;

class Client
{
    const WSDL_URL_LOGIN = 'https://login.twinfield.com/webservices/session.asmx?wsdl';

    const WSDL_URL_SESSION = '%s/webservices/session.asmx?wsdl';

    public function __construct()
    {
        $this->client = new \SoapClient(self::WSDL_URL_LOGIN, array(
            'classmap' => $this->getClassMap(),
            'trace'    => 1,
        ));
    }

    private function getClassMap()
    {
        return array(
            'LogonResponse' => 'Pronamic\Twinfield\LogonResponse',
        );
    }

    public function getSession(Credentials $credentials)
    {
        $session = null;

        $response = $this->client->Logon($credentials);

        // Check response is successful
        if (LogonResult::OK == $response->getResult()) {
            // Response from the logon request
            $xml = $this->client->__getLastResponse();

            $soapEnvelope    = simplexml_load_string($xml, null, null, 'http://schemas.xmlsoap.org/soap/envelope/');
            $soapHeader      = $soapEnvelope->Header;
            $twinfieldHeader = $soapHeader->children('http://www.twinfield.com/')->Header;

            $sessionId = (string) $twinfieldHeader->SessionID;

            // Session
            $session = new Session($sessionId, $response->getCluster());
        }

        return $session;
    }
}
