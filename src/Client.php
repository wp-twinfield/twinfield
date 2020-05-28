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
	/**
	 * Services.
	 *
	 * @var array
	 */
	private $services;

	/**
	 * Number retires.
	 *
	 * @var int
	 */
	private $number_retires = 0;

	/**
	 * Constructs and initializes a Twinfield client object.
	 *
	 * @param AuthenticationStrategy $authentication_strategy Authentication strategy.
	 */
	public function __construct( AuthenticationStrategy $authentication_strategy ) {
		$this->authentication_strategy = $authentication_strategy;

		$this->services = array();
	}

	/**
	 * Get cluster.
	 *
	 * @return mixed
	 */
	public function get_cluster() {
		return $this->cluster;
	}

	/**
	 * Login.
	 */
	public function login() {
		$this->authentication_info = $this->authentication_strategy->login();

		$this->cluster = $this->authentication_info->get_cluster();

		if ( isset( $this->authentication_info->session_id ) ) {
			$this->session_id = $this->authentication_info->session_id;
		}

		if ( isset( $this->authentication_info->access_token ) ) {
			$this->access_token = $this->authentication_info->access_token;
		}

		$this->authenticate_services();
	}

	/**
	 * Authenticate services.
	 */
	private function authenticate_services() {
		foreach ( $this->services as $service ) {
			$service->authenticate( $this->authentication_info );
		}
	}

	/**
	 * Handle exception.
	 */
	public function handle_exception() {

	}

	/**
	 * Get service by name.
	 *
	 * @param string $name Name.
	 * @return mixed
	 */
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

	/**
	 * Generate new service by name.
	 *
	 * @param string $name Name.
	 * @return mixed
	 */
	private function new_service( $name ) {
		switch ( $name ) {
			case 'declarations':
				return new Declarations\DeclarationsService( $this );
			case 'deleted-transactions':
				return new Transactions\DeletedTransactionsService( $this );
			case 'document':
				return new Documents\DocumentService( $this );
			case 'finder':
				return new Finder( $this );
			case 'session':
				return new SessionClient( $this );
			case 'processxml':
				return new XMLProcessor( $this );
			case 'periods':
				return new Periods\PeriodsService( $this );
			case 'hierarchies':
				return new Hierarchies\HierarchiesService( $this );
			default:
				return false;
		}
	}

	/**
	 * Set service.
	 *
	 * @param string $name    Name.
	 * @param mixed  $service Service.
	 */
	private function set_service( $name, $service ) {
		if ( $this->authentication_info ) {
			$service->authenticate( $this->authentication_info );
		}

		$this->services[ $name ] = $service;
	}

	/**
	 * Get finder.
	 *
	 * @return Finder
	 */
	public function get_finder() {
		return $this->get_service( 'finder' );
	}

	/**
	 * Get XML processor.
	 *
	 * @return XMLProcessor
	 */
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
			// https://github.com/php-twinfield/twinfield/issues/50.
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
			'Query'                      => __NAMESPACE__ . '\Query',
			'GetDeletedTransactions'     => __NAMESPACE__ . '\Transactions\GetDeletedTransactions',
			'GetYears'                   => __NAMESPACE__ . '\Periods\QueryGetYears',
			'GetPeriods'                 => __NAMESPACE__ . '\Periods\QueryGetPeriods',
		);
	}
}
