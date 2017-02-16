<?php
/**
 * Transaction response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\Response;

/**
 * Transaction response
 *
 * This class follows the Data Transfer Objects design pattern. This class represents an Twinfield sales invoice with some
 * additional information.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionResponse extends Response {
	/**
	 * The transaction.
	 *
	 * @var Transaction
	 */
	private $transaction;

	/**
	 * Constructs and initialize an Twinfield article read request.
	 *
	 * @param Transaction       $transaction   A transaction.
	 * @param int               $result        The number of results.
	 * @param \SimpleXMLElement $message       The XML message.
	 */
	public function __construct( Transaction $transaction, $result, \SimpleXMLElement $message ) {
		parent::__construct( $result, $message );

		$this->transaction = $transaction;
	}

	/**
	 * Get the transaction.
	 *
	 * @return string
	 */
	public function get_transaction() {
		return $this->transaction;
	}
}
