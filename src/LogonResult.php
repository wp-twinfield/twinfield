<?php
/**
 * Logon result
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Long result
 *
 * This class contains constants for different Twinfield logon result codes.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class LogonResult {
	/**
	 * Ok Log-on successful.
	 *
	 * @var string
	 */
	const OK = 'Ok';

	/**
	 * Log-on is blocked, because of system maintenance.
	 *
	 * @var string
	 */
	const BLOCKED = 'Blocked';

	/**
	 * Log-on is not trusted.
	 *
	 * @var string
	 */
	const UNTRUSTED = 'Untrusted';

	/**
	 * Log-on is invalid.
	 *
	 * @var string
	 */
	const INVALID = 'Invalid';

	/**
	 * User is deleted.
	 *
	 * @var string
	 */
	const DELETED = 'Deleted';

	/**
	 * User is disabled.
	 *
	 * @var string
	 */
	const DISABLED = 'Disabled';

	/**
	 * Organization is inactive.
	 *
	 * @var string
	 */
	const ORGANISATION_INACTIVE = 'OrganisationInactive';
}
