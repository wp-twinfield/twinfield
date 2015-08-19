<?php
/**
 * Logon response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Logon response
 *
 * This class represents an Twinfield logon response.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class LogonResponse {
	/**
	 * Logon result
	 *
	 * @var string
	 */
	private $LogonResult;

	/**
	 * Next required log-on action.
	 *
	 * @var string
	 */
	private $nextAction;

	/**
	 * Cluser.
	 *
	 * @var string
	 */
	private $cluster;

	/**
	 * Get the next required log-on action.
	 *
	 * @return string
	 */
	public function get_next_action() {
		return $this->nextAction;
	}

	/**
	 * Get the logon result code.
	 *
	 * @return string
	 */
	public function get_result() {
		return $this->LogonResult;
	}

	/**
	 * Get the cluster code.
	 *
	 * @return string
	 */
	public function get_cluster() {
		return $this->cluster;
	}
}
