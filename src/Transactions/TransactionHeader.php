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

	/**
	 * Get period.
	 *
	 * @return string
	 */
	public function get_period() {
		return $this->period;
	}

	/**
	 * Set period.
	 *
	 * @param string $period
	 */
	public function set_period( $period ) {
		$this->period = $period;
	}

	/**
	 * Get currency.
	 *
	 * @return string
	 */
	public function get_currency() {
		return $this->currency;
	}

	/**
	 * Set currency.
	 *
	 * @param string $currency
	 */
	public function set_currency( $currency ) {
		$this->currency = $currency;
	}

	/**
	 * Get date.
	 *
	 * @return \DateTime
	 */
	public function get_date() {
		return $this->date;
	}

	/**
	 * Set date.
	 *
	 * @param \DateTime $date
	 */
	public function set_date( \DateTime $date = null ) {
		$this->date = $date;
	}
}
