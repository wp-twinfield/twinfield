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

    private function findSessionId() {
        // Parse last response
        $xml = $this->client->__getLastResponse();

        $soapEnvelope    = simplexml_load_string($xml, null, null, 'http://schemas.xmlsoap.org/soap/envelope/');
        $soapHeader      = $soapEnvelope->Header;
        $twinfieldHeader = $soapHeader->children('http://www.twinfield.com/')->Header;

        // Session ID
        $this->sessionId = (string) $twinfieldHeader->SessionID;
    }

    /**
     * Logon with the specified credentials
     *
     * @param Credentials $credentials
     * @return LogonResponse
     */
    public function logon(Credentials $credentials) {
        $response = $this->client->Logon($credentials);

        $this->findSessionId();

        return $response;
    }

    public function getSession(LogonResponse $logonResponse)
    {
        $session = null;

        // Check response is successful
        if (LogonResult::OK == $logonResponse->getResult()) {
            // Session
            $session = new Session($this->sessionId, $logonResponse->getCluster());
        }

        return $session;
    }
}
