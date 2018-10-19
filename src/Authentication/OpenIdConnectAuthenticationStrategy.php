<?php
/**
 * Web services authentication strategy.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

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
class OpenIdConnectAuthenticationStrategy extends AuthenticationStrategy {
	/**
	 * Construct.
	 *
	 * @param string $access_token Access token.
	 * @param string $office       Office.
	 * @param string $cluster      Cluster.
	 */
	public function __construct( $access_token, $office, $cluster ) {
		$this->access_token = $access_token;
		$this->office       = $office;
		$this->cluster      = $cluster;
	}

	/**
	 * Login.
	 *
	 * @return AuthenticationInfo
	 */
	public function login() {
		$soap_header = new \SoapHeader(
			'http://www.twinfield.com/',
			'Header',
			array(
				'AccessToken' => $this->access_token,
				'CompanyCode' => $this->office,
			)
		);

		$info = new AuthenticationInfo( $this->cluster, $soap_header );

		$info->access_token = $this->access_token;

		return $info;
	}
}
