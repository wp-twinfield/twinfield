<?php
/**
 * User
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Users;

use Pronamic\WP\Twinfield\CodeName;
use Pronamic\WP\Twinfield\Organisation\Organisation;

/**
 * User
 *
 * This class represents a Twinfield user
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class User extends CodeName {
	/**
	 * Organisation.
	 *
	 * @var Organisation|null
	 */
	private $organisation;
}
