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
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/BankTransactions
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/CashTransactions
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/JournalTransactions
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/PurchaseTransactions
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Transaction {
	/**
	 * Location.
	 *
	 * Indicate the destiny of the purchase transaction:
	 * `temporary` = purchase transaction is saved as `provisional`
	 * `final` = purchase transaction is saved as `final`
	 *
	 * @var string|null
	 */
	private $location;

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
	 * Get location.
	 *
	 * @return string|null
	 */
	public function get_location() {
		return $this->location;
	}

	/**
	 * Set location.
	 *
	 * @param string|null $location Location.
	 */
	public function set_location( $location ) {
		$this->location = $location;
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
		$line = new TransactionLine( $this );

		$this->add_line( $line );

		return $line;
	}
}
