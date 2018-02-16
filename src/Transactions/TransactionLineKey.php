<?php
/**
 * Transaction Line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

/**
 * Transaction Line Key
 *
 * This class represents a Twinfield transaction line key.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionLineKey {
	/**
	 * The office of this transaction line.
	 *
	 * @var string
	 */
	private $office;

	/**
	 * The code of this transaction line.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * The number of this transaction line.
	 *
	 * @var string
	 */
	private $number;

	/**
	 * The line of this transaction line.
	 *
	 * @var string
	 */
	private $line;

	/**
	 * Constructs and initialize a Twinfield transaction line.
	 *
	 * @param string $office The office code.
	 * @param string $code   The code.
	 * @param string $number The number.
	 * @param string $line   The line number.
	 */
	public function __construct( $office, $code, $number, $line ) {
		$this->office = $office;
		$this->code   = $code;
		$this->number = $number;
		$this->line   = $line;
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
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
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
	 * Get line.
	 *
	 * @return string
	 */
	public function get_line() {
		return $this->line;
	}
}
