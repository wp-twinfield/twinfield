<?php
/**
 * Sales Invoice Header
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

/**
 * Sales Invoice Header
 *
 * This class represents an Twinfield sales invoice header.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceHeader {
	/**
	 * Office.
	 *
	 * @var string
	 */
	private $office;

	/**
	 * Type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Number
	 *
	 * @var string
	 */
	private $number;

	/**
	 * Date
	 *
	 * @var \DateTime
	 */
	private $date;

	/**
	 * Due date
	 *
	 * @var \DateTime
	 */
	private $due_date;

	/**
	 * Bank
	 *
	 * @var string
	 */
	private $bank;

	/**
	 * Get office.
	 *
	 * @return string
	 */
	public function get_office() {
		return $this->office;
	}

	/**
	 * Set office
	 *
	 * @param string $office
	 */
	public function set_office( $office ) {
		$this->office = $office;
	}

	/**
	 * Get type.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Set type
	 *
	 * @param string $office
	 */
	public function set_type( $type ) {
		$this->type = $type;
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
	 * Set number
	 *
	 * @param string $number
	 */
	public function set_number( $number ) {
		$this->number = $number;
	}

	/**
	 * Get date.
	 *
	 * @return \DateTime
	 */
	public function get_date() {
		return $this->number;
	}

	/**
	 * Set date.
	 *
	 * @param \DateTime $date
	 */
	public function set_date( \DateTime $date ) {
		$this->date = $date;
	}

	/**
	 * Get due date.
	 *
	 * @return \DateTime
	 */
	public function get_due_date() {
		return $this->due_date;
	}

	/**
	 * Set due date.
	 *
	 * @param \DateTime $date
	 */
	public function set_due_date( \DateTime $due_date ) {
		$this->due_date = $due_date;
	}

	/**
	 * Get bank.
	 *
	 * @return string
	 */
	public function get_bank() {
		return $this->bank;
	}

	/**
	 * Set bank.
	 *
	 * @param string $bank
	 */
	public function set_bank( $bank ) {
		$this->bank = $bank;
	}
}
