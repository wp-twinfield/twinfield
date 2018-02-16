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
	private $LogonResult; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Next required log-on action.
	 *
	 * @var string
	 */
	private $nextAction; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Cluser.
	 *
	 * @var string
	 */
	private $cluster;

	/**
	 * Session ID.
	 *
	 * The session ID is officially not part of the logon response.
	 * To make this library easier to use we store it temporary in
	 * logon repsonse object.
	 *
	 * @var string
	 */
	public $session_id;

	/**
	 * Get the next required log-on action.
	 *
	 * @return string
	 */
	public function get_next_action() {
		return $this->nextAction; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
	}

	/**
	 * Get the logon result code.
	 *
	 * @return string
	 */
	public function get_result() {
		return $this->LogonResult; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
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
