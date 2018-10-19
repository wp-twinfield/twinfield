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
	 * The session used to connect to webservice.
	 *
	 * @var Session
	 */
	protected $session;

	/**
	 * SOAP Client object.
	 *
	 * @var \SoapClient
	 */
	protected $soap_client;

	/**
	 * Constructs and initializes a Twinfield client object.
	 *
	 * @param string $wsdl_file WSDL file path.
	 * @param Client $client    Client.
	 */
	public function __construct( $wsdl_file, Client $client ) {
		$this->wsdl_file = $wsdl_file;

		$this->client = $client;

		$this->soap_client = new \SoapClient( $this->get_wsdl_url(), Client::get_soap_client_options() );
	}

	/**
	 * Authenticate.
	 *
	 * @param AuthenticationInfo $authentication_info Authentication info.
	 */
	public function authenticate( AuthenticationInfo $authentication_info ) {
		$this->soap_client->__setSoapHeaders( $authentication_info->get_soap_header() );
	}

	/**
	 * Get the WSDL URL for this client.
	 *
	 * @return string
	 */
	protected function get_wsdl_url() {
		return $this->client->get_cluster() . $this->wsdl_file;
	}
}
