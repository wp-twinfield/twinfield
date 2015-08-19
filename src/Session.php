<?php

namespace Pronamic\Twinfield;

class Session
{
	public $sessionId;

	public function __construct($sessionId, $cluster) {

		$this->sessionId = $sessionId;
		$this->cluster = $cluster;

		$this->client = new \SoapClient($this->getWsdlUrl(), array(
			'classmap' => $this->getClassMap(),
		));
		$this->client->__setSoapHeaders( $this->getSoapHeader() );
	}

	private function getWsdlUrl() {

		return sprintf( Client::WSDL_URL_SESSION, $this->cluster );
	}

	private function getSoapHeader() {

		return new \SoapHeader( 'http://www.twinfield.com/', 'Header', array( 'SessionID' => $this->getId() ) );
	}

	private function getClassMap() {

		return array(
			'SelectCompanyResponse' => 'Pronamic\Twinfield\SelectCompanyResponse',
		);
	}

	public function getId() {

		return $this->sessionId;
	}

	public function getCluster() {

		return $this->cluster;
	}

	public function selectCompany($companyCode) {

		$selectCompany = new \stdClass();
		$selectCompany->company = $companyCode;

		$response = $this->client->SelectCompany( $selectCompany );

		return $response;
	}
}
