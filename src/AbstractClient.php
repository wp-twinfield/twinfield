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
	 * @param Session $session         The Twinfield session.
	 */
	public function __construct( $wsdl_file, Session $session ) {
		$this->wsdl_file = $wsdl_file;
		$this->session   = $session;

		$this->soap_client = new \SoapClient( $this->get_wsdl_url(), array(
			'classmap' => Client::get_class_map(),
			'trace'    => 1,
		) );

		$this->soap_client->__setSoapHeaders( $this->get_soap_header() );
	}

	/**
	 * Get the WSDL URL for this client.
	 *
	 * @return string
	 */
	private function get_wsdl_url() {
		return $this->session->get_cluster() . $this->wsdl_file;
	}

	/**
	 * Get SOAP header with the session ID.
	 *
	 * @return \SoapHeader
	 */
	private function get_soap_header() {
		return new \SoapHeader( 'http://www.twinfield.com/', 'Header', array( 'SessionID' => $this->session->get_id() ) );
	}
}
