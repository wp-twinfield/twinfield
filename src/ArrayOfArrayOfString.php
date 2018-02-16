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
	 * Add the specified array of string to this object.
	 *
	 * @param ArrayOfString $array Add the specified array.
	 */
	public function add( ArrayOfString $array ) {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$this->ArrayOfString[] = $array;
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		return new \ArrayIterator( $this->ArrayOfString );
	}
}
