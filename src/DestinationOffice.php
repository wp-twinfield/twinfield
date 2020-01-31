<?php
/**
 * Destination office
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Destination office
 *
 * This class represents a Twinfield destination office.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DestinationOffice extends CodeName {
	/**
	 * Dimension 1.
	 *
	 * @var CodeName|null
	 */
	private $dimension_1;

	/**
	 * Construct a destination office.
	 *
	 * @param string      $code      Code.
	 * @param string|null $name      Name.
	 * @param string|null $shortname Shortname.
	 */
	public function __construct( $code ) {
		parent::__construct( $code );
	}

	/**
	 * Get dimension 1.
	 *
	 * @return CodeName|null
	 */
	public function get_dimension_1() {
		return $this->dimension_1;
	}

	/**
	 * Set dimension 1.
	 *
	 * @param CodeName|null $dimension_1 Dimension 1.
	 */
	public function set_dimension_1( $dimension_1 ) {
		$this->dimension_1 = $dimension_1;
	}
}
