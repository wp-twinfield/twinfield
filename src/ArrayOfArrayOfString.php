<?php
/**
 * Array of array of string
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Array of array of string
 *
 * This class represents the 'ArrayOfArrayOfString' Twinfield class.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArrayOfArrayOfString implements \IteratorAggregate {
	/**
	 * An array with array strings.
	 *
	 * @var array
	 */
	private $ArrayOfString; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Constructs and initializes an array of array of string object.
	 */
	public function __construct() {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$this->ArrayOfString = array();
	}

	/**
	 * Ensure array.
	 */
	private function ensure_array() {
		if ( is_object( $this->ArrayOfString ) ) {
			$this->ArrayOfString = array( $this->ArrayOfString );
		}
	}

	/**
	 * Get array.
	 *
	 * @return array
	 */
	public function get_array() {
		$this->ensure_array();

		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		return $this->ArrayOfString;
	}

	/**
	 * Add the specified array of string to this object.
	 *
	 * @param ArrayOfString $array Add the specified array.
	 */
	public function add( ArrayOfString $array ) {
		$this->ensure_array();

		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$this->ArrayOfString[] = $array;
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->get_array() );
	}

	/**
	 * Parse array into array of array of string.
	 *
	 * @param array $array The array to convert to an array of array string object.
	 * @return \ArrayOfArrayOfString
	 */
	public static function parse_array( $array ) {
		$aa = new ArrayOfArrayOfString();

		foreach ( $array as $key => $value ) {
			$a = new ArrayOfString();

			$a->add( $key );
			$a->add( $value );

			$aa->add( $a );
		}

		return $aa;
	}
}
