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
	 * An array with message of error codes.
	 *
	 * @var mixed
	 */
	private $MessageOfErrorCodes;

	/**
	 * Constructs and initializes an array of array of string object
	 *
	 * @param array $data An array of array of strings
	 */
	public function __construct() {
		$this->MessageOfErrorCodes = array();
	}

	/**
	 * If there is only one error the `MessageOfErrorCodes` variable is not an array.
	 * This function will correct this when needed.
	 */
	public function get_array() {
		if ( is_array( $this->MessageOfErrorCodes ) ) {
			return $this->MessageOfErrorCodes;
		} else {
			if ( $this->MessageOfErrorCodes instanceof MessageOfErrorCodes ) {
				return array( $this->MessageOfErrorCodes );
			} else {
				return array();
			}
		}
	}

	/**
	 * Add the specified array of string to this object.
	 *
	 * @param ArrayOfString $array add the specified array.
	 */
	public function add( MessageOfErrorCodes $error ) {
		$this->MessageOfErrorCodes = $this->get_array();

		$this->MessageOfErrorCodes[] = $error;
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->get_array() );
	}
}
