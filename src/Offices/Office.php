<?php
/**
 * Office
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Offices;

/**
 * Office
 *
 * This class represents an Twinfield office
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Office {
	/**
	 * Code.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Shortname.
	 *
	 * @var string
	 */
	private $shortname;

	/**
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Set code.
	 *
	 * @param string $code
	 */
	public function set_code( $code ) {
		$this->code = $code;
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Set name.
	 *
	 * @param string $name
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * Get shortname.
	 *
	 * @return string
	 */
	public function get_shortname() {
		return $this->shortname;
	}

	/**
	 * Set shortname.
	 *
	 * @param string $shortname
	 */
	public function set_shortname( $shortname ) {
		$this->shortname = $shortname;
	}
}
