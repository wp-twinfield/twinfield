<?php
/**
 * Client
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Abstract client
 *
 * This class connects to the Twinfield Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
abstract class AbstractClient {
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
	 * Constructs and initializes an Twinfield client object.
	 *
	 * @param string  $wsdl_file       The WSDL file path.
	 * @param AuthenticationInfo $authentication_info A Twinfield authentication info object.
	 */
	public function __construct( $wsdl_file, AuthenticationInfo $authentication_info ) {
		$this->wsdl_file = $wsdl_file;

		$this->authentication_info = $authentication_info;

		$this->soap_client = new \SoapClient( $this->get_wsdl_url(), Client::get_soap_client_options() );

		$this->soap_client->__setSoapHeaders( $authentication_info->get_soap_header() );
	}

	/**
	 * Get the WSDL URL for this client.
	 *
	 * @return string
	 */
	private function get_wsdl_url() {
		return $this->authentication_info->get_cluster() . $this->wsdl_file;
	}
}
