<?php
/**
 * Finder
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

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
	 * @param Session $session The Twinfield session.
	 */
	public function __construct( Session $session ) {
		parent::__construct( self::WSDL_FILE, $session );
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
