<?php
/**
 * Credentials
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Credentials
 *
 * This class represents an  to the Twinfield finder Webservices to search for Twinfield masters.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Credentials {
	/**
	 * User code.
	 *
	 * @var string
	 */
	private $user;

	/**
	 * Password.
	 *
	 * @var string
	 */
	private $password;

	/**
	 * Organization code.
	 *
	 * @var string
	 */
	private $organisation;

	/**
	 * Constructs and initializes an credentials object.
	 *
	 * @param string $user         User code.
	 * @param string $password     Password.
	 * @param string $organisation Organization code.
	 */
	public function __construct( $user, $password, $organisation ) {
		$this->user         = $user;
		$this->password     = $password;
		$this->organisation = $organisation;
	}
}
