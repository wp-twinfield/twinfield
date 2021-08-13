<?php
/**
 * Client
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Authentication\AccessTokenValidation;
use Pronamic\WP\Twinfield\Authentication\AuthenticationInfo;
use Pronamic\WP\Twinfield\Authentication\AuthenticationTokens;
use Pronamic\WP\Twinfield\Authentication\OpenIdConnectClient;
use Pronamic\WP\Twinfield\Authentication\InvalidTokenException;
use Pronamic\WP\Twinfield\Offices\OfficeService;
use Pronamic\WP\Twinfield\Offices\Office;

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
	 * Constructs and initializes a Twinfield client object.
	 *
	 * @param OpenIdConnectClient $openid_connect_client OpenID Connect Client.
	 * @param AuthenticationInfo  $authentication        Authentication info.
	 */
	public function __construct( OpenIdConnectClient $openid_connect_client, AuthenticationInfo $authentication ) {
		$this->openid_connect_client = $openid_connect_client;

		$this->set_authentication( $authentication );

		$this->services = array();
	}

	public function get_authentication() {
		return $this->authentication;
	}

	public function set_authentication( AuthenticationInfo $authentication ) {
		$this->authentication = $authentication;

		$this->user = $this->authentication->get_validation()->get_user();

		$this->organisation = $this->user->get_organisation();

		$this->cluster_url = $this->authentication->get_validation()->get_cluster_url();
	}

	public function set_authentication_refresh_handler( $callback ) {
		$this->authentication_refresh_handler = $callback;
	}

	public function authenticate() {
		if ( $this->authentication->get_validation()->is_expired() ) {
			$response = $this->openid_connect_client->refresh_token( $this->authentication->get_tokens()->get_refresh_token() );
			
			$tokens = AuthenticationTokens::from_object( $response );

			$response = $this->openid_connect_client->get_access_token_validation( $tokens->get_access_token() );

			$validation = AccessTokenValidation::from_object( $response );

			$authentication = new AuthenticationInfo( $tokens, $validation );

			$this->set_authentication( $authentication );

			if ( \is_callable( $this->authentication_refresh_handler ) ) {
				\call_user_func( $this->authentication_refresh_handler, $this );
			}
		}

		return $this->authentication;
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
			case 'budget':
				return new Budget\BudgetService( $this );
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

	public function get_organisation() {
		return $this->organisation;
	}

	public function get_user() {
		return $this->user;
	}

	public function get_offices() {
		$office_service = new OfficeService( $this );

		return $office_service->get_offices();
	}

	public function get_office( Office $office ) {
		$office_service = new OfficeService( $this );

		return $office_service->get_office( $office );
	}

	public function get_transaction_types( Office $office ) {
		$finder = $this->get_finder();

		// Request.
		$search = new \Pronamic\WP\Twinfield\Search(
			'TRS',
			'*',
			0,
			1,
			100,
			array(
				'hidden' => '1',
			)
		);

		$finder->set_office( $office );

		$response = $finder->search( $search );

		$data = $response->get_data();

		$items = $data->get_items();

		$transaction_types = array();

		foreach ( $items as $item ) {
			$transaction_type = $office->new_transaction_type( $item[0] );

			$transaction_type->set_name( $item[1] );

			$transaction_types[] = $transaction_type;
		}

		return $transaction_types;
	}

	private function get_wsdl_url( $wsdl_file ) {
		return $this->cluster_url . $wsdl_file;
	}

	public function new_soap_client( $wsdl_file ) {
		return new \SoapClient( $this->get_wsdl_url( $wsdl_file ), $this->get_soap_client_options() );
	}

	/**
	 * Get SOAP Client options.
	 *
	 * @return array
	 */
	private function get_soap_client_options() {
		return array(
			'classmap'           => $this->get_class_map(),
			'connection_timeout' => 30,
			'trace'              => true,
			'compression'        => \SOAP_COMPRESSION_ACCEPT | \SOAP_COMPRESSION_GZIP,
			// https://github.com/php-twinfield/twinfield/issues/50.
			'cache_wsdl'         => \WSDL_CACHE_MEMORY,
			// Disable HTTP Keep Alive to prevent 'error fetching HTTP headers'.
			'keep_alive'         => false,
		);
	}

	/**
	 * Get the class map to connect Twinfield classes to classes in this library.
	 *
	 * @return array
	 */
	private function get_class_map() {
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
			'GetBudgetByProfitAndLoss'   => __NAMESPACE__ . '\Budget\GetBudgetByProfitAndLossQuery',
			'GetBudgetTotalsResult'      => __NAMESPACE__ . '\Budget\GetBudgetTotalsResult',
			'GetBudgetTotalResult'       => __NAMESPACE__ . '\Budget\GetBudgetTotalResult',
		);
	}
}
