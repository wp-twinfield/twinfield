<?php
/**
 * Array of message of error codes
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Array of message of error codes
 *
 * This class represents the 'ArrayOfMessageOfErrorCodes' Twinfield class.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArrayOfMessageOfErrorCodes implements \IteratorAggregate {
	/**
	 * An array with array strings.
	 *
	 * @var MessageOfErrorCodes
	 */
	private $MessageOfErrorCodes;

	/**
	 * Constructs and initializes an array of array of string object
	 *
	 * @param array $data An array of array of strings
	 */
	public function __construct() {
		$this->ArrayOfString = array();
	}

	/**
	 * Add the specified array of string to this object.
	 *
	 * @param ArrayOfString $array add the specified array.
	 */
	public function add( ArrayOfString $array ) {
		$this->ArrayOfString[] = $array;
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->ArrayOfString );
	}
}
