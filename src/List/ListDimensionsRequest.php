<?php
/**
 * List dimensions request.
 *
 * @since      1.0.0
 * @see        https://c3.twinfield.com/webservices/documentation/#/GettingStarted/WebServicesOverview#List-entities
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Session
 *
 * This class represents an Twinfield session.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ListDimensionsRequest {
	/**
	 * Specify what dimension type of data to list.
	 *
	 * @var string
	 */
	private $dimension_type;

	/**
	 * Constructs and initialize an Twinfield read request.
	 *
	 * @param string $office         Specify from wich office to read.
	 * @param string $dimension_type Specify what type of data to read.
	 */
	public function __construct( $office, $dimension_type ) {
		parent::__construct( ListEntities::DIMENSIONS, $office );

		$this->dimension_type = $dimension_type;
	}

	/**
	 * Get the dimension type.
	 *
	 * @return string
	 */
	public function get_dimension_type() {
		return $this->dimension_type;
	}
}
