<?php
/**
 * Abstract service
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Authentication\AuthenticationInfo;
use Pronamic\WP\Twinfield\Offices\Office;
use SoapClient;
use SoapHeader;

/**
 * Abstract service
 *
 * This class connects to the Twinfield Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
abstract class AbstractService {
	/**
	 * The WSDL file path.
	 *
	 * @var string
	 */
	private $wsdl_file;

	/**
	 * SOAP Client object.
	 *
	 * @var SoapClient
	 */
	private $soap_client;

	/**
	 * Office.
	 * 
	 * @var Office|null
	 */
	private $office;

	/**
	 * Constructs and initializes a Twinfield client object.
	 *
	 * @param string $wsdl_file WSDL file path.
	 * @param Client $client    Client.
	 */
	public function __construct( $wsdl_file, Client $client ) {
		$this->wsdl_file = $wsdl_file;

		$this->client = $client;

		$this->soap_client = $client->new_soap_client( $wsdl_file );
	}

	/**
	 * Set office.
	 * 
	 * @param Office|null $office Office.
	 */
	public function set_office( Office $office = null ) {
		$this->office = $office;
	}

	/**
	 * Get SOAP client.
	 *
	 * @return SoapClient
	 */
	public function get_soap_client() {
		$authentication = $this->client->authenticate();

		$data = array(
			'AccessToken' => $authentication->get_tokens()->get_access_token(),
		);

		if ( null !== $this->office ) {
			$data['CompanyCode'] = $this->office->get_code();
		}

		$this->soap_header = new SoapHeader(
			'http://www.twinfield.com/',
			'Header',
			$data
		);

		$this->soap_client->__setSoapHeaders( $this->soap_header );

		return $this->soap_client;
	}
}
