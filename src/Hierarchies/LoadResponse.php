<?php
/**
 * Load Response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Hierarchies;

/**
 * Load Response
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class LoadResponse {
	/**
	 * Hierarchy.
	 *
	 * @var Hierarchy
	 */
	private $hierarchy;

	/**
	 * Construct load response.
	 *
	 * @param Hierarchy $hierarchy Hierarchy.
	 */
	public function __construct( $hierarchy ) {
		$this->hierarchy = $hierarchy;
	}

	/**
	 * Get hierarchy.
	 *
	 * @return Hierarchy
	 */
	public function get_hierarchy() {
		return $this->hierarchy;
	}

	/**
	 * Convert from object.
	 *
	 * @param object $object Object.
	 * @return LoadResponse
	 */
	public static function from_object( $object ) {
		$hierarchy = Hierarchy::from_object( $object->hierarchy );

		$load_response = new LoadResponse( $hierarchy );

		return $load_response;
	}
}
