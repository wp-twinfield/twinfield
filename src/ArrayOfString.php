<?php
/**
 * Array of string
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Array of array of string
 *
 * This class represents the 'ArrayOfString' Twinfield class.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArrayOfString implements \IteratorAggregate {
	/**
	 * An array with strings
	 *
	 * @var array
	 */
	private $string;

	/**
	 * Constructs and initializes an array of array of string object
	 *
	 * @param array $data An array of array of strings
	 */
	public function __construct() {
		$this->string = array();
	}

	/**
	 * Add the specified string to this array of string object.
	 *
	 * @param $string add the specified string.
	 */
	public function add( $string ) {
		$this->string[] = $string;
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->string );
	}
}
