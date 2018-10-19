<?php
/**
 * Web services authentication strategy.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

use Pronamic\WP\Twinfield\Credentials;
use Pronamic\WP\Twinfield\LoginClient;
use Pronamic\WP\Twinfield\LogonResult;

/**
 * Authentication strategy.
 *
 * This class contains constants for different Twinfield browse codes.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 * @see        https://github.com/opauth/opauth
 */
class WebServicesAuthenticationStrategy extends AuthenticationStrategy {
	/**
	 * Credentials.
	 *
	 * @var Credentials
	 */
	private $credentials;

	/**
	 * Cluster.
	 *
	 * @var string
	 */
	private $cluster;

	/**
	 * Session ID.
	 *
	 * @var string
	 */
	private $session_id;

	/**
	 * Constructs a web services authentication strategy.
	 *
	 * @param Credentials $credentials The credentialis for the web services authentication.
	 */
	public function __construct( Credentials $credentials ) {
		$this->credentials = $credentials;

		$this->login_client = new LoginClient();
	}

	/**
	 * Execute the login action.
	 */
	public function login() {
		$this->logon_response = $this->login_client->logon( $this->credentials );

		if ( empty( $this->logon_response ) ) {
			return false;
		}

		if ( LogonResult::OK === $this->logon_response->get_result() ) {
			$cluster    = $this->logon_response->get_cluster();
			$session_id = $this->login_client->get_session_id();

			$soap_header = new \SoapHeader(
				'http://www.twinfield.com/',
				'Header',
				array(
					'SessionID' => $session_id,
				)
			);

			$info = new AuthenticationInfo( $cluster, $soap_header );
			$info->session_id = $session_id;

			return $info;
		}

		return false;
	}
}
