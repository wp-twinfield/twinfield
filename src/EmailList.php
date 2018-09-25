<?php
/**
 * Email List
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Email List
 *
 * This class connects to the Twinfield finder Webservices to search for Twinfield masters.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class EmailList implements \IteratorAggregate {
	/**
	 * Twinfield delimter for emails in a list.
	 *
	 * @var string
	 */
	const DELIMITER = ',';

	/**
	 * Emails.
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 * Constructs and initializes an email list object.
	 *
	 * @param string|array $data Data.
	 */
	public function __construct( $data ) {
		if ( is_string( $data ) ) {
			$data = explode( self::DELIMITER, $data );
			$data = array_filter( $data );
			$data = array_map( 'trim', $data );
		}

		if ( is_array( $data ) ) {
			$this->data = $data;
		}
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->data );
	}

	/**
	 * Create a string represantation of this email list.
	 *
	 * @return string
	 */
	public function __toString() {
		return implode( self::DELIMITER, $this->data );
	}
}
