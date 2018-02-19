<?php
/**
 * Finder
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Authentication\AuthenticationStrategy;

/**
 * Finder
 *
 * This class connects to the Twinfield finder Webservices to search for Twinfield masters.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Finder extends AbstractClient {
	/**
	 * The Twinfield finder WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/finder.asmx?wsdl';

	/**
	 * Constructs and initializes an finder object.
	 *
	 * @param AuthenticationInfo $authentication_info A Twinfield authentication info object.
	 */
	public function __construct( AuthenticationInfo $authentication_info ) {
		parent::__construct( self::WSDL_FILE, $authentication_info );
	}

	/**
	 * Send the specified search request to Twinfield.
	 *
	 * @param Search $search An Twinfield search object.
	 * @return SearchResponse
	 */
	public function search( Search $search ) {
		$response = $this->soap_client->Search( $search );

		return $response;
	}
}
