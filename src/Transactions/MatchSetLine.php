<?php
/**
 * Match set line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

/**
 * Match set line
 *
 * This class represents a Twinfield match set line.
 *
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/JournalTransactions
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class MatchSetLine {
	/**
	 * Daybook code.
	 *
	 * @var string
	 */
	public $code;

	/**
	 * Transaction number.
	 *
	 * @var int
	 */
	public $number;

	/**
	 * Transaction line number.
	 *
	 * @var int
	 */
	public $line;

	/**
	 * Method.
	 *
	 * @var string
	 */
	public $method;

	/**
	 * Match value.
	 *
	 * @var float
	 */
	public $match_value;
}
