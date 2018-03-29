<?php
/**
 * OpenID Connect Provider
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

/**
 * OpenID Connect Provider
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 * @see        https://github.com/opauth/opauth
 */
class OpenIdConnectProvider {
	const URL_AUTHORIZE = 'https://login.twinfield.com/auth/authentication/connect/authorize';

	const URL_TOKEN = 'https://login.twinfield.com/auth/authentication/connect/token';

	const URL_ACCESS_TOKEN_VALIDATION = 'https://login.twinfield.com/auth/authentication/connect/accesstokenvalidation';

	const URL_USER_INFO = 'https://login.twinfield.com/auth/authentication/connect/userinfo';

	public function __construct( $client_id, $client_secret, $redirect_uri ) {
		$this->client_id     = $client_id;
		$this->client_secret = $client_secret;
		$this->redirect_uri  = $redirect_uri;
	}

	/**
	 * Get authorization header.
	 *
	 * @see https://developer.wordpress.org/plugins/http-api/#get-using-basic-authentication
	 * @see https://c3.twinfield.com/webservices/documentation/#/ApiReference/Authentication/OpenIdConnect#General-information
	 * @return string
	 */
	private function get_authorization_header() {
		return 'Basic ' . base64_encode( $this->client_id . ':' . $this->client_secret );
	}

	private function get_headers() {
		return array(
			'Authorization' => $this->get_authorization_header(),
		);
	}

	public function get_authorize_url( $state ) {
		$url = self::URL_AUTHORIZE;

		$url = add_query_arg( array(
			'client_id'     => $this->client_id,
			'response_type' => 'code',
			'scope'         => implode( '+', array(
				'openid',
				'twf.user',
				'twf.organisation',
				'twf.organisationUser',
				'offline_access',
			) ),
			'redirect_uri'  => $this->redirect_uri,
			// @see https://auth0.com/docs/protocols/oauth2/oauth-state
			'state'         => base64_encode( wp_json_encode( $state ) ),
			'nonce'         => wp_create_nonce( 'twinfield-auth' ),
		), $url );

		return $url;
	}

	public function get_access_token( $code ) {
		$url = self::URL_TOKEN;

		$result = wp_remote_post( $url, array(
			'headers' => $this->get_headers(),
			'body'    => array(
				'grant_type'   => 'authorization_code',
				'code'         => $code,
				'redirect_uri' => $this->redirect_uri,
			),
		) );

		if ( is_wp_error( $result ) ) {
			return false;
		}

		$body = wp_remote_retrieve_body( $result );

		$data = json_decode( $body );

		return $data;
	}

	public function get_access_token_validation( $access_token ) {
		if ( empty( $access_token ) ) {
			return false;
		}

		$url = self::URL_ACCESS_TOKEN_VALIDATION;
		$url = add_query_arg( 'token', $access_token, $url );

		$result = wp_remote_get( $url );

		if ( is_wp_error( $result ) ) {
			return false;
		}

		$body = wp_remote_retrieve_body( $result );

		$data = json_decode( $body );

		return $data;
	}

	public function refresh_token( $refresh_token ) {
		if ( empty( $refresh_token ) ) {
			return false;
		}

		$url = self::URL_TOKEN;

		$result = wp_remote_post( $url, array(
			'headers' => $this->get_headers(),
			'body'    => array(
				'grant_type'    => 'refresh_token',
				'refresh_token' => $refresh_token,
			),
		) );

		if ( is_wp_error( $result ) ) {
			return false;
		}

		$body = wp_remote_retrieve_body( $result );

		$data = json_decode( $body );

		return $data;
	}
}
