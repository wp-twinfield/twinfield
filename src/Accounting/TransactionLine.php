<?php
/**
 * Transaction Line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Accounting;

use DOMDocument;

/**
 * Transaction Line
 *
 * This class represents a Twinfield transaction line.
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
class TransactionLine {
	private $transaction;

	private $type;

	private $value;

	private $invoice_number;

	private $description;

	public function __construct( $transaction ) {
		$this->transaction = $transaction;
	}

	public function get_type() {
		return $this->type;
	}

	public function set_type( $type ) {
		$this->type = $type;
	}

	public function get_id() {
		return $this->id;
	}

	public function set_id( $id ) {
		$this->id = $id;
	}

	public function get_dimension_1() {
		return $this->dimension_1;
	}

	public function set_dimension_1( $dimension ) {
		$this->dimension_1 = $dimension;
	}

	public function get_dimension_2() {
		return $this->dimension_2;
	}

	public function set_dimension_2( $dimension ) {
		$this->dimension_2 = $dimension;
	}

	public function get_dimension_3() {
		return $this->dimension_3;
	}

	public function set_dimension_3( $dimension ) {
		$this->dimension_3 = $dimension;
	}

	public function get_debit_credit() {
		return $this->debit_credit;
	}

	public function set_debit_credit( $debit_credit ) {
		$this->debit_credit = $debit_credit;
	}

	public function get_value() {
		return $this->value;
	}

	public function set_value( $value ) {
		$this->value = $value;
	}

	public function get_invoice_number() {
		return $this->invoice_number;
	}

	public function set_invoice_number( $invoice_number ) {
		$this->invoice_number = $invoice_number;
	}

	public function get_description() {
		return $this->description;
	}

	public function set_description( $description ) {
		$this->description = $description;
	}
}
