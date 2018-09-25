<?php
/**
 * Session client test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

/**
 * Session client test
 *
 * This class will test the Twinfield session client class.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SessionClientTest extends TestCase {
	/**
	 * Test logon
	 */
	public function test_logon() {
		global $credentials;

		$authentication_strategy = new WebServicesAuthenticationStrategy( $credentials );

		$client = new Client( $authentication_strategy );

		$client->login();

		// Test session client.
		$session_client = $client->get_service( 'session' );

		// Test select company.
		$response = $session_client->select_company( '11024' );

		$this->assertInstanceOf( __NAMESPACE__ . '\SelectCompanyResponse', $response );
		$this->assertSame( SelectCompanyResult::OK, $response->get_result() );
	}
}
