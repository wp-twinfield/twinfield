<?php
/**
 * Transaction Header
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\Currency;
use Pronamic\WP\Twinfield\Offices\Office;
use Pronamic\WP\Twinfield\Relations\Relation;

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
	 * @param string $office The office.
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
	 * @param string $code The code.
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
	 * @param string $number The number.
	 */
	public function set_number( $number ) {
		$this->number = $number;
	}

	/**
	 * Get currency.
	 *
	 * @return Currency
	 */
	public function get_currency() {
		return $this->currency;
	}

	/**
	 * Set currency.
	 *
	 * @param Currency $currency The currency.
	 */
	public function set_currency( Currency $currency = null ) {
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
	 * @param \DateTime $date The date.
	 */
	public function set_date( \DateTime $date = null ) {
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
	 * @param \DateTime $date The input date.
	 */
	public function set_input_date( \DateTime $date ) {
		$this->input_date = $date;
	}

	/**
	 * Get relation.
	 *
	 * @return Relation
	 */
	public function get_relation() {
		return $this->relation;
	}

	/**
	 * Set relation.
	 *
	 * @param Relation $relation Relation.
	 */
	public function set_relation( Relation $relation = null ) {
		$this->relation = $relation;
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
	 * @param string $status The status.
	 */
	public function set_status( $status ) {
		$this->status = $status;
	}

	/**
	 * Get username.
	 *
	 * @return string
	 */
	public function get_username() {
		return $this->username;
	}

	/**
	 * Set year.
	 *
	 * @param string $username Username.
	 */
	public function set_username( $username ) {
		$this->username = $username;
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
	 * @param int $year The year.
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
	 * @param int $period The period.
	 */
	public function set_period( $period ) {
		$this->period = $period;
	}

	/**
	 * Get origin.
	 *
	 * @return string
	 */
	public function get_origin() {
		return $this->origin;
	}

	/**
	 * Set origin.
	 *
	 * @param string $origin Origin.
	 */
	public function set_origin( $origin ) {
		$this->origin = $origin;
	}
}
