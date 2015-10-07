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
class ArrayOfString implements \ArrayAccess, \IteratorAggregate {
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
	 * Check if the specified offset exists.
	 *
	 * @param mixed $offset
	 * @return boolean
	 */
	public function offsetExists( $offset ) {
		return isset( $this->string[ $offset ] );
	}

	/**
	 * Get the string value at the specified offset.
	 *
	 * @param mixed $offset
	 * @return mixed
	 */
	public function offsetGet( $offset ) {
		if ( isset( $this->string[ $offset ] ) ) {
			return $this->string[ $offset ];
		} else {
			return null;
		}
	}

	/**
	 * Set the value at the specified offset.
	 *
	 * @param mixed $offset
	 * @param mixed $value
	 */
	public function offsetSet( $offset, $value ) {
		if ( is_null( $offset ) ) {
			$this->string[] = $value;
		} else {
			$this->string[ $offset ] = $value;
		}
	}

	/**
	 * Unset the value at the specified offset.
	 *
	 * @param mixed $offset
	 */
	public function offsetUnset( $offset ) {
		unset( $this->string[ $offset ] );
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
