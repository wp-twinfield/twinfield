<?php
/**
 * Match set
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

/**
 * Match set
 *
 * This class represents a Twinfield match set.
 *
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Transactions/JournalTransactions
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class MatchSet {
	/**
	 * Status of the transaction. `temporary` if the transaction is posted provisional. `final` if the transaction is posted final.
	 *
	 * @var string
	 */
	public $status;

	/**
	 * Match date.
	 *
	 * @var \DateTimeInterface
	 */
	public $match_date;

	/**
	 * Match value.
	 *
	 * @var float
	 */
	public $match_value;

	/**
	 * Lines.
	 *
	 * @var array<MatchSetLine>
	 */
	public $lines;

	/**
	 * Construct match set.
	 */
	public function __construct() {
		$this->lines = array();
	}
}
