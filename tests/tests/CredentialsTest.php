<?php
/**
 * Credentials test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Credentials test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		$user         = getenv( 'TWINFIELD_USER' );
		$password     = getenv( 'TWINFIELD_PASSWORD' );
		$organisation = getenv( 'TWINFIELD_ORGANISATION' );

		$credentials = new Credentials( $user, $password, $organisation );

		$this->assertInstanceOf( __NAMESPACE__ . '\Credentials', $credentials );
	}
}
