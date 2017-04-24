<?php
/**
 * Logon test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use PHPUnit\Framework\TestCase;

/**
 * Logon test
 *
 * This class will test the Twinfield logon features.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class LogonTest extends TestCase {
	/**
	 * Test logon
	 */
	public function test_logon() {
		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );
		$this->assertInstanceOf( __NAMESPACE__ . '\LogonResponse', $logon_response );

		$next_action = $logon_response->get_next_action();
		$this->assertEquals( LogonAction::NONE, $next_action );

		$cluster = $logon_response->get_cluster();
		$this->assertInternalType( 'string', $cluster );

		$session = $client->get_session( $logon_response );

		$this->assertInstanceOf( __NAMESPACE__ . '\Session', $session );
		$this->assertInternalType( 'string', $session->get_id() );
	}
}
