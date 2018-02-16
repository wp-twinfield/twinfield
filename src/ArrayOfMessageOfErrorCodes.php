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
	private $MessageOfErrorCodes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Constructs and initializes an array of array of string object.
	 */
	public function __construct() {
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$this->MessageOfErrorCodes = array();
	}

	/**
	 * If there is only one error the `MessageOfErrorCodes` variable is not an array.
	 * This function will correct this when needed.
	 */
	public function get_array() {
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.

		if ( is_array( $this->MessageOfErrorCodes ) ) {
			return $this->MessageOfErrorCodes;
		} else {
			if ( $this->MessageOfErrorCodes instanceof MessageOfErrorCodes ) {
				return array( $this->MessageOfErrorCodes );
			} else {
				return array();
			}
		}

		// phpcs:enable
	}

	/**
	 * Add the specified array of string to this object.
	 *
	 * @param MessageOfErrorCodes $error Add the specified array.
	 */
	public function add( MessageOfErrorCodes $error ) {
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.

		$this->MessageOfErrorCodes = $this->get_array();

		$this->MessageOfErrorCodes[] = $error;

		// phpcs:enable
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
