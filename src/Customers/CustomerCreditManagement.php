<?php
/**
 * Customer credit management
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Customers;

/**
 * Customer
 *
 * This class represents Twinfield customer credit management.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerCreditManagement {
	/**
	 * Determines if and how a customer will be reminded.
	 *
	 * @var string true, email, false
	 */
	private $send_reminder;

	/**
	 * Mandatory if `sendreminder` is email.
	 *
	 * @var string
	 */
	private $reminder_email;

	/**
	 * Get the send reminder value.
	 *
	 * @return string
	 */
	public function get_send_reminder() {
		return $this->office;
	}

	/**
	 * Set the send reminder value.
	 *
	 * @param string $send_reminder
	 */
	public function set_send_reminder( $send_reminder ) {
		$this->send_reminder = $send_reminder;
	}

	/**
	 * Get the reminder email.
	 *
	 * @return string
	 */
	public function get_reminder_email() {
		return $this->reminder_email;
	}

	/**
	 * Set the reminder email.
	 *
	 * @param string $send_reminder
	 */
	public function set_reminder_email( $reminder_email ) {
		$this->reminder_email = $reminder_email;
	}
}
