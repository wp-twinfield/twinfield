<?php
/**
 * Client
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Authentication\AuthenticationStrategy;

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
	private $services;

	private $number_retires = 0;

	/**
	 * Constructs and initializes an Twinfield client object.
	 */
	public function __construct( AuthenticationStrategy $authentication_strategy ) {
		$this->authentication_strategy = $authentication_strategy;

		$this->services = array();
	}

	public function get_cluster() {
		return $this->cluster;
	}

	public function login() {
		$this->authentication_info = $this->authentication_strategy->login();

		$this->cluster = $this->authentication_info->get_cluster();

		$this->authenticate_services();
	}

	private function authenticate_services() {
		foreach ( $this->services as $service ) {
			$service->authenticate( $this->authentication_info );
		}
	}

	public function handle_exception() {

	}

	public function get_service( $name ) {
		if ( isset( $this->services[ $name ] ) ) {
			return $this->services[ $name ];
		}

		$service = $this->new_service( $name );

		if ( $service ) {
			$this->set_service( $name, $service );
		}

		return $service;
	}

	private function new_service( $name ) {
		switch ( $name ) {
			case 'declarations':
				return new Declarations\DeclarationsService( $this );
			case 'finder':
				return new Finder( $this );
			case 'session':
				return new SessionClient( $this );
			case 'processxml':
				return new XMLProcessor( $this );
			default:
				return false;
		}
	}

	private function set_service( $name, $service ) {
		if ( $this->authentication_info ) {
			$service->authenticate( $this->authentication_info );
		}

		$this->services[ $name ] = $service;
	}

	public function get_finder() {
		return $this->get_service( 'finder' );
	}

	public function get_xml_processor() {
		return $this->get_service( 'processxml' );
	}

	/**
	 * Get SOAP Client options.
	 *
	 * @return array
	 */
	public static function get_soap_client_options() {
		return array(
			'classmap'           => self::get_class_map(),
			'connection_timeout' => 30,
			'trace'              => true,
			'compression'        => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
			// https://github.com/php-twinfield/twinfield/issues/50
			'cache_wsdl'         => WSDL_CACHE_MEMORY,
			// Disable HTTP Keep Alive to prevent 'error fetching HTTP headers'.
			'keep_alive'         => false,
		);
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
}
