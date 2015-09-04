<?php
/**
 * Session client test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Session client test
 *
 * This class will test the Twinfield session client class.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SessionClientTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test logon
	 */
	public function test_logon() {
		global $credentials;

		$client = new Client();

		// Test logon.
		$logon_response = $client->logon( $credentials );

		$this->assertInstanceOf( __NAMESPACE__ . '\LogonResponse', $logon_response );
		$this->assertInternalType( 'string', $logon_response->get_cluster() );

		// Test session.
		$session = $client->get_session( $logon_response );

		$this->assertInstanceOf( __NAMESPACE__ . '\Session', $session );
		$this->assertInternalType( 'string', $session->get_id() );

		// Test session client.
		$session_client = new SessionClient( $session );

		// Test select company.
		$response = $session_client->select_company( '11024' );

		$this->assertInstanceOf( __NAMESPACE__ . '\SelectCompanyResponse', $response );
		$this->assertSame( SelectCompanyResult::OK, $response->get_result() );
	}
}
