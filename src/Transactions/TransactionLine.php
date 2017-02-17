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
	 * The unique ID of this transaction line.
	 *
	 * @var string
	 */
	private $id;

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
}
