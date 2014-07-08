<?php

/**
 * Title: Logon test
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_Twinfield_LogonTest extends PHPUnit_Framework_TestCase {
    public function testLogon() {
        global $credentials;

        $client = new Pronamic\Twinfield\Client();

        $logonResponse = $client->logon($credentials);

        $this->assertInstanceOf('Pronamic\Twinfield\LogonResponse', $logonResponse);
        $this->assertInternalType('string', $logonResponse->getCluster());

        $session = $client->getSession($logonResponse);

        $this->assertInstanceOf('Pronamic\Twinfield\Session', $session);
        $this->assertInternalType('string', $session->getId());

        $response = $session->selectCompany('11024');

        $this->assertInstanceOf('Pronamic\Twinfield\SelectCompanyResponse', $response);
        $this->assertSame(Pronamic\Twinfield\SelectCompanyResult::OK, $response->getResult());
    }
}
