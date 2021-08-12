<?php
/**
 * UUID Trait
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * UUID Trait
 *
 * This class represents a Twinfield code and name.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
trait UuidTrait {
	/**
	 * UUID.
	 *
	 * @var string|null
	 */
	private $uuid;

	/**
	 * Get UUID.
	 *
	 * @return string|null
	 */
	public function get_uuid() {
		return $this->uuid;
	}

	/**
	 * Set UUID.
	 *
	 * @param string $uuid UUID
	 */
	public function set_uuid( $uuid ) {
		$this->uuid = $uuid;
	}
}
