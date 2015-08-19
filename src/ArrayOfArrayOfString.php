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
	private $ArrayOfString;

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->ArrayOfString );
	}
}
