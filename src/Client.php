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
 * Client
 *
 * This class connects to the Twinfield Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Client {
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
		$this->soap_client = new \SoapClient( self::WSDL_URL_LOGIN, array(
			'classmap' => self::get_class_map(),
			'trace'    => 1,
		) );
	}

	/**
	 * Get the class map to connect Twinfield classes to classes in this library.
	 *
	 * @return array
	 */
	public static function get_class_map() {
		return array(
			'ArrayOfArrayOfString'       => __NAMESPACE__ . '\ArrayOfArrayOfString',
			'ArrayOfMessageOfErrorCodes' => __NAMESPACE__ . '\ArrayOfMessageOfErrorCodes',
			'ArrayOfString'              => __NAMESPACE__ . '\ArrayOfString',
			'FinderData'                 => __NAMESPACE__ . '\FinderData',
			'LogonResponse'              => __NAMESPACE__ . '\LogonResponse',
			'MessageOfErrorCodes'        => __NAMESPACE__ . '\MessageOfErrorCodes',
			'ProcessXmlStringResponse'   => __NAMESPACE__ . '\ProcessXmlStringResponse',
			'SearchResponse'             => __NAMESPACE__ . '\SearchResponse',
			'SelectCompanyResponse'      => __NAMESPACE__ . '\SelectCompanyResponse',
		);
	}

	/**
	 * Find the session ID from the last Twinfield response message.
	 */
	private function get_session_id() {
		// Parse last response.
		$xml = $this->soap_client->__getLastResponse();

		$soap_envelope    = simplexml_load_string( $xml, null, null, 'http://schemas.xmlsoap.org/soap/envelope/' );
		$soap_header      = $soap_envelope->Header;
		$twinfield_header = $soap_header->children( 'http://www.twinfield.com/' )->Header;

		// Session ID.
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

		/*
		 * The session ID is officially not part of the logon response.
		 * To make this library easier to use we store it temporary in
		 * logon repsonse object.
		 */
		$logon_response->session_id = $this->get_session_id();

		return $logon_response;
	}

	/**
	 * Create an new session object from an logon response object.
	 *
	 * @param LogonResponse $logon_response An logon response is required to create a new session object.
	 * @return Session An Twinfield session object.
	 */
	public function get_session( LogonResponse $logon_response ) {
		$session = null;

		// Check if logon response result code is OK.
		if ( LogonResult::OK === $logon_response->get_result() ) {
			/*
			 * The session ID is officially not part of the logon response.
			 * To make this library easier to use we store it temporary in
			 * logon repsonse object.
			 */
			$session_id = $logon_response->session_id;

			$session = new Session( $session_id, $logon_response->get_cluster() );
		}

		return $session;
	}

	/**
	 * Create an new finder object.
	 *
	 * @param Session $session An Twinfield session object which contains the session ID.
	 * @return Finder An Twinfield finder client object.
	 */
	public function get_finder( Session $session ) {
		$finder = new Finder( $session );

		return $finder;
	}

	/**
	 * Create an new XML processor object.
	 *
	 * @param Session $session An Twinfield session object which contains the session ID.
	 * @return Finder An Twinfield XML processor client object.
	 */
	public function get_xml_processor( Session $session ) {
		$xml_processor = new XMLProcessor( $session );

		return $xml_processor;
	}
}
