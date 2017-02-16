<?php
/**
 * Transaction
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

/**
 * Transaction
 *
 * This class represents a Twinfield transaction.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Transaction {
	/**
	 * Header.
	 *
	 * @var TransactionHeader
	 */
	private $header;

	/**
	 * Lines.
	 *
	 * @var array
	 */
	private $lines;

	/**
	 * Constructs and initialize a Twinfield transaction.
	 */
	public function __construct() {
		$this->header = new TransactionHeader();
		$this->lines  = array();
	}

	/**
	 * Get transaction header.
	 *
	 * @return TransactionHeader
	 */
	public function get_header() {
		return $this->header;
	}

	/**
	 * Get the transaction lines.
	 *
	 * @return array
	 */
	public function get_lines() {
		return $this->lines;
	}

	/**
	 * Add the specified line to this transaction.
	 *
	 * @param TransactionLine $line The transaction line to add.
	 */
	public function add_line( TransactionLine $line ) {
		$this->lines[] = $line;
	}

	/**
	 * Create a new transaction line.
	 *
	 * @return TransactionLine
	 */
	public function new_line() {
		$line = new TransactionLine();

		$this->add_line( $line );

		return $line;
	}
}
