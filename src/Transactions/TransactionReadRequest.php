<?php
/**
 * Transaction read request
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\ReadRequest;

/**
 * Transaction read request
 *
 * This class represents an Twinfield sales invoice read request.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionReadRequest extends ReadRequest {
	/**
	 * Specifcy which transaction type to read.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Specifcy which transaction number to read.
	 *
	 * @var string
	 */
	private $number;

	/**
	 * Constructs and initialize an Twinfield transaction read request.
	 *
	 * @param string $office Specify from wich office to read.
	 * @param string $code   Specifcy which transaction code to read.
	 * @param string $number The transaction number.
	 */
	public function __construct( $office, $code, $number ) {
		parent::__construct( 'transaction', $office );

		$this->code   = $code;
		$this->number = $number;
	}

	/**
	 * Get the transaction type code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Get the transaction number.
	 *
	 * @return string
	 */
	public function get_number() {
		return $this->number;
	}
}
