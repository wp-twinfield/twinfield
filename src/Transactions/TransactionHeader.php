<?php
/**
 * Transaction Header
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

/**
 * Transaction Header
 *
 * This class represents a Twinfield transaction header.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionHeader {
	/**
	 * Office.
	 *
	 * @var string
	 */
	private $office;

	/**
	 * Code.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Constructs and initializes a transaction header.
	 */
	public function __construct() {
		
	}

	/**
	 * Get office.
	 *
	 * @return string
	 */
	public function get_office() {
		return $this->office;
	}

	/**
	 * Set office.
	 *
	 * @param string $office
	 */
	public function set_office( $office ) {
		$this->office = $office;
	}

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
	 * @param string $office
	 */
	public function set_code( $code ) {
		$this->code = $code;
	}

	/**
	 * Get number.
	 *
	 * @return string
	 */
	public function get_number() {
		return $this->number;
	}

	/**
	 * Set number.
	 *
	 * @param string $office
	 */
	public function set_number( $number ) {
		$this->number = $number;
	}
}
