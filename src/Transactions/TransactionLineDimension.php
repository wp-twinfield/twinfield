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
class TransactionLineDimension {
	/**
	 * The code of this dimension.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * The name of this dimension.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * The type of this dimension.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Constructs and initialize a Twinfield transaction line.
	 */
	public function __construct( $code, $name = null, $type = null ) {
		$this->code = $code;
		$this->name = $name;
		$this->type = $type;
	}

	/**
	 * Get the code of this dimension.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->id;
	}

	/**
	 * Get the name of this dimension.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Get the type of this dimension.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->type;
	}
}
