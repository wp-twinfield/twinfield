<?php
/**
 * Credentials test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use PHPUnit\Framework\TestCase;

/**
 * Credentials test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CredentialsTest extends TestCase {
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
