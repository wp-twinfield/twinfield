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
 * Transaction Line
 *
 * This class represents a Twinfield transaction line.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionLine {
	/**
	 * Debit.
	 */
	const DEBIT = 'debit';

	/**
	 * Credit.
	 */
	const CREDIT = 'credit';

	/**
	 * The unique key of this transaction line.
	 *
	 * @var TransactionLineKey
	 */
	private $key;

	/**
	 * The debit/credit indicator of this transaction line.
	 *
	 * @var string
	 */
	private $debit_credit;

	/**
	 * Input date.
	 */
	private $input_date;

	/**
	 * Year.
	 */
	private $year;

	/**
	 * Period.
	 */
	private $period;

	/**
	 * Constructs and initialize a Twinfield transaction line.
	 */
	public function __construct() {

	}

	/**
	 * Get the unique ID of this transaction line.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Set the unique ID of this transaction line.
	 *
	 * @param string $id
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Get the unique key of this transaction line.
	 *
	 * @return string
	 */
	public function get_key() {
		return $this->key;
	}

	/**
	 * Set the unique key of this transaction line.
	 *
	 * @param string $id
	 */
	public function set_key( $key ) {
		$this->key = $key;
	}

	/**
	 * Get the status of this transaction line.
	 *
	 * @return string
	 */
	public function get_status() {
		return $this->status;
	}

	/**
	 * Set the status of this transaction line.
	 *
	 * @param string $status
	 */
	public function set_status( $status ) {
		$this->status = $status;
	}

	/**
	 * Get the type of this transaction line.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Set the type of this transaction line.
	 *
	 * @param string $type
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * Get dimension 1 of this transaction line.
	 *
	 * @return string
	 */
	public function get_dimension_1() {
		return $this->dimension_1;
	}

	/**
	 * Set dimension 1 of this transaction line.
	 *
	 * @param TransactionLineDimension $dimension
	 */
	public function set_dimension_1( TransactionLineDimension $dimension ) {
		$this->dimension_1 = $dimension;
	}

	/**
	 * Get dimension 2 of this transaction line.
	 *
	 * @return string
	 */
	public function get_dimension_2() {
		return $this->dimension_2;
	}

	/**
	 * Set dimension 2 of this transaction line.
	 *
	 * @param TransactionLineDimension $dimension
	 */
	public function set_dimension_2( TransactionLineDimension $dimension ) {
		$this->dimension_2 = $dimension;
	}

	/**
	 * Get the value of this transaction line.
	 *
	 * @return string
	 */
	public function get_value() {
		return $this->value;
	}

	/**
	 * Set the value of this transaction line.
	 *
	 * @param string $value
	 */
	public function set_value( $value ) {
		$this->value = $value;
	}

	/**
	 * Get the base value of this transaction line.
	 *
	 * @return string
	 */
	public function get_base_value() {
		return $this->base_value;
	}

	/**
	 * Set the base value of this transaction line.
	 *
	 * @param string $value
	 */
	public function set_base_value( $value ) {
		$this->base_value = $value;
	}

	/**
	 * Get the open base value of this transaction line.
	 *
	 * @return string
	 */
	public function get_open_base_value() {
		return $this->open_base_value;
	}

	/**
	 * Set the open base value of this transaction line.
	 *
	 * @param string $value
	 */
	public function set_open_base_value( $value ) {
		$this->open_base_value = $value;
	}

	/**
	 * Get the description of this transaction line.
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set the description of this transaction line.
	 *
	 * @param string $description
	 */
	public function set_description( $description ) {
		$this->description = $description;
	}

	/**
	 * Get the invoice number of this transaction line.
	 *
	 * @return string
	 */
	public function get_invoice_number() {
		return $this->invoice_number;
	}

	/**
	 * Set the invoice number of this transaction line.
	 *
	 * @param string $invoice_number
	 */
	public function set_invoice_number( $invoice_number ) {
		$this->invoice_number = $invoice_number;
	}

	/**
	 * Get debit credit.
	 *
	 * @return string
	 */
	public function get_debit_credit() {
		return $this->debit_credit;
	}

	/**
	 * Set debit credit.
	 *
	 * @param string $debit_credit
	 */
	public function set_debit_credit( $debit_credit ) {
		$this->debit_credit = $debit_credit;
	}

	/**
	 * Is debit.
	 *
	 * @return boolean true if is debit, false otherwise.
	 */
	public function is_debit() {
		return self::DEBIT === $this->get_debit_credit();
	}

	/**
	 * Is credit.
	 *
	 * @return boolean true if is credit, false otherwise.
	 */
	public function is_credit() {
		return self::CREDIT === $this->get_debit_credit();
	}

	/**
	 * Get the date of this transaction line.
	 *
	 * @return \DateTime
	 */
	public function get_date() {
		return $this->date;
	}

	/**
	 * Set the date of this transaction line.
	 *
	 * @param \DateTime $date
	 */
	public function set_date( \DateTime $date ) {
		$this->date = $date;
	}

	/**
	 * Get the input date of this transaction line.
	 *
	 * @return \DateTime
	 */
	public function get_input_date() {
		return $this->input_date;
	}

	/**
	 * Set the input date of this transaction line.
	 *
	 * @param \DateTime $date
	 */
	public function set_input_date( \DateTime $date ) {
		$this->input_date = $date;
	}

	/**
	 * Get year.
	 *
	 * @return int
	 */
	public function get_year() {
		return $this->year;
	}

	/**
	 * Set year.
	 *
	 * @param int $year
	 */
	public function set_year( $year ) {
		$this->year = $year;
	}

	/**
	 * Get period.
	 *
	 * @return int
	 */
	public function get_period() {
		return $this->period;
	}

	/**
	 * Set period.
	 *
	 * @param int $period
	 */
	public function set_period( $period ) {
		$this->period = $period;
	}
}
