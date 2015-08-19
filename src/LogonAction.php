<?php
/**
 * Logon action
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Logon action
 *
 * This class contains constants for different Twinfield logon actions.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class LogonAction {
	/**
	 * No action required.
	 *
	 * @var string
	 */
	const NONE = 'None';

	/**
	 * The next required action is SMS authentication.
	 *
	 * @var string
	 */
	const SMS_LOGON = 'SMSLogon';

	/**
	 * The next required action is change of password.
	 *
	 * @var string
	 */
	const CHANGE_PASSWORD = 'ChangePassword';
}
