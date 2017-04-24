<?php
/**
 * Finder
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Documents;

use Pronamic\WP\Twinfield\AbstractClient;
use Pronamic\WP\Twinfield\Session;

/**
 * Finder
 *
 * This class connects to the Twinfield finder Webservices to search for Twinfield masters.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DocumentService extends AbstractClient {
	/**
	 * The Twinfield finder WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/DocumentService.svc?wsdl';

	/**
	 * Constructs and initializes an finder object.
	 *
	 * @param Session $session The Twinfield session.
	 */
	public function __construct( Session $session ) {
		parent::__construct( self::WSDL_FILE, $session );
	}

	/**
	 * Query.
	 */
	public function query() {

	}
}
