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
 * Login client
 *
 * This class connects to the Twinfield Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class LoginClient {
	/**
	 * The Twinfield WSDL login URL.
	 *
	 * @var string
	 */
	const WSDL_URL_LOGIN = 'https://login.twinfield.com/webservices/session.asmx?wsdl';

	/**
	 * Constructs and initializes an Twinfield client object.
	 */
	public function __construct() {
		$this->soap_client = new \SoapClient( self::WSDL_URL_LOGIN, Client::get_soap_client_options() );
	}

	/**
	 * Find the session ID from the last Twinfield response message.
	 */
	public function get_session_id() {
		if ( empty( $this->xml_logon_response ) ) {
			return false;
		}

		// Parse last response.
		$soap_envelope = simplexml_load_string( $this->xml_logon_response, null, null, 'http://schemas.xmlsoap.org/soap/envelope/' );

		if ( false === $soap_envelope ) {
			return false;
		}

		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- XML tag.
		$soap_header = $soap_envelope->Header;

		$twinfield_header = $soap_header->children( 'http://www.twinfield.com/' )->Header;

		// Session ID.
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- XML tag.
		$session_id = (string) $twinfield_header->SessionID;

		return $session_id;
	}

	/**
	 * Logon with the specified credentials
	 *
	 * @param Credentials $credentials Logon with the specified credentials.
	 * @return LogonResponse
	 */
	public function logon( Credentials $credentials ) {
		$logon_response = $this->soap_client->Logon( $credentials );

		$this->xml_logon_response = $this->soap_client->__getLastResponse();

		return $logon_response;
	}

	/**
	 * Keep the session alive, to prevent session time out. A session time out will occur 2 hours after the last web service call for the session.
	 */
	public function keep_alive() {
		$this->soap_client->KeepAlive();
	}
}
