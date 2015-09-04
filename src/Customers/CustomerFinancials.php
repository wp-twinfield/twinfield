<?php
/**
 * Customer financials
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

/**
 * Customer financials
 *
 * This class represents Twinfield customer financials.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerFinancials {
	/**
	 * The number of due days.
	 *
	 * @var int
	 */
	private $due_days;

	/**
	 * Get the number of due days.
	 *
	 * @return int
	 */
	public function get_due_days() {
		return $this->office;
	}

	/**
	 * Set the number of due days.
	 *
	 * @param int $due_days
	 */
	public function set_office( $due_days ) {
		$this->due_days = $due_days;
	}
}
