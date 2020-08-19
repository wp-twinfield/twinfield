<?php
/**
 * Hierarchy
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Hierarchies;

use Pronamic\WP\Twinfield\AbstractService;
use Pronamic\WP\Twinfield\Client;

/**
 * Hierarchy
 *
 * This class connects to the Twinfield hierarchy Webservices.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class HierarchiesService extends AbstractService {
	/**
	 * The Twinfield finder WSDL URL.
	 *
	 * @var string
	 */
	const WSDL_FILE = '/webservices/hierarchies.asmx?wsdl';

	/**
	 * Constructs and initializes an finder object.
	 *
	 * @param Client $client Twinfield client object.
	 */
	public function __construct( Client $client ) {
		parent::__construct( self::WSDL_FILE, $client );
	}

	/**
	 * Get hierarchy by code.
	 *
	 * @return LoadResponse
	 */
	public function get_hierarchy( $hierarchy_code ) {
		$result = $this->soap_client->Load( (object) array(
			'hierarchyCode' => $hierarchy_code,
		) );

		return LoadResponse::from_object( $result );
	}
}
