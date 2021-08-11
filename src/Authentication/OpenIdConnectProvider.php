<?php
/**
 * OpenID Connect Provider
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

use Pronamic\WordPress\Http\Facades\Http;

/**
 * OpenID Connect Provider
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 * @see        https://github.com/opauth/opauth
 */
class OpenIdConnectProvider {
	/**
	 * Authorize URL.
	 *
	 * @var string
	 */
	const URL_AUTHORIZE = 'https://login.twinfield.com/auth/authentication/connect/authorize';

	/**
	 * Token URL.
	 *
	 * @var string
	 */
	const URL_TOKEN = 'https://login.twinfield.com/auth/authentication/connect/token';

	/**
	 * Access token validation URL.
	 *
	 * @var string
	 */
	const URL_ACCESS_TOKEN_VALIDATION = 'https://login.twinfield.com/auth/authentication/connect/accesstokenvalidation';

	/**
	 * User info URL.
	 *
	 * @var string
	 */
	const URL_USER_INFO = 'https://login.twinfield.com/auth/authentication/connect/userinfo';

	/**
	 * Construct.
	 *
	 * @param string $client_id     Client ID.
	 * @param string $client_secret Client secret.
	 * @param string $redirect_uri  Redirect URI.
	 */
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

	/**
	 * Get headers.
	 *
	 * @return array
	 */
	private function get_headers() {
		return array(
			'Authorization' => $this->get_authorization_header(),
		);
	}

	/**
	 * Get authorize URL.
	 *
	 * @param mixed $state State.
	 * @return string
	 */
	public function get_authorize_url( $state ) {
		$url = self::URL_AUTHORIZE;

		$url = add_query_arg(
			array(
				'client_id'     => $this->client_id,
				'response_type' => 'code',
				'scope'         => implode(
					'+',
					array(
						'openid',
						'twf.user',
						'twf.organisation',
						'twf.organisationUser',
						'offline_access',
					)
				),
				'redirect_uri'  => $this->redirect_uri,
				// @see https://auth0.com/docs/protocols/oauth2/oauth-state
				'state'         => base64_encode( wp_json_encode( $state ) ),
				'nonce'         => wp_create_nonce( 'twinfield-auth' ),
			),
			$url
		);

		return $url;
	}

	/**
	 * Get access token.
	 *
	 * @param string $code Code.
	 * @return string
	 */
	public function get_access_token( $code ) {
		$url = self::URL_TOKEN;

		$result = Http::post(
			$url,
			array(
				'headers' => $this->get_headers(),
				'body'    => array(
					'grant_type'   => 'authorization_code',
					'code'         => $code,
					'redirect_uri' => $this->redirect_uri,
				),
			)
		);

		$data = $result->json();

		if ( ! \is_object( $data ) ) {
			throw new \Exception(
				\sprintf(
					'Unknow response from `%s` endpoint: %s.',
					$url,
					\print_r( $data, true )
				)
			);
		}

		if ( \property_exists( $data, 'error' ) ) {
			throw new \Exception(
				\sprintf(
					'Received error from `%s` endpoint: %s.',
					$url,
					\print_r( $data->error, true )
				)
			);
		}

		return $data;
	}

	/**
	 * Get access token validation.
	 *
	 * @param string $access_token Access token.
	 * @return mixed
	 */
	public function get_access_token_validation( $access_token ) {
		$url = self::URL_ACCESS_TOKEN_VALIDATION;
		$url = \add_query_arg( 'token', $access_token, $url );

		$result = Http::get( $url );

		$data = $result->json();

		if ( ! \is_object( $data ) ) {
			throw new \Exception(
				\sprintf(
					'Unknow response from `%s` endpoint: %s.',
					$url,
					\print_r( $data, true )
				)
			);
		}

		return $data;
	}

	/**
	 * Refresh token.
	 *
	 * @param string $refresh_token Refresh token.
	 * @return mixed
	 */
	public function refresh_token( $refresh_token ) {
		if ( empty( $refresh_token ) ) {
			return false;
		}

		$url = self::URL_TOKEN;

		$result = wp_remote_post(
			$url,
			array(
				'headers' => $this->get_headers(),
				'body'    => array(
					'grant_type'    => 'refresh_token',
					'refresh_token' => $refresh_token,
				),
			)
		);

		if ( is_wp_error( $result ) ) {
			return false;
		}

		$body = wp_remote_retrieve_body( $result );

		$data = json_decode( $body );

		return $data;
	}

	/**
	 * Get user info.
	 *
	 * curl --header "Authorization: Bearer ●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●●" https://login.twinfield.com/auth/authentication/connect/userinfo
	 *
	 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Authentication/OpenIdConnect
	 * @link https://connect2id.com/products/server/docs/api/userinfo
	 * @param string $acces_token Access token.
	 * @return object
	 */
	public function get_user_info( $access_token ) {
		$url = self::URL_USER_INFO;

		$result = Http::get(
			$url,
			array(
				'headers' => array(
					'Authorization' => 'Bearer ' . $access_token,
				),
			)
		);

		$data = $result->json();

		return $data;
	}

	/**
	 * Maybe handle Twinfield OpenID Authorization return.
	 */
	public function maybe_handle_twinfield_return( $data, $callback ) {
		if ( ! \array_key_exists( 'code', $data ) ) {
			return false;
		}

		if ( ! \array_key_exists( 'state', $data ) ) {
			return false;
		}

		if ( ! \array_key_exists( 'session_state', $data ) ) {
			return false;
		}

		$code = $data['code'];

		$data = $this->get_access_token( $code );

		if ( \is_callable( $callback ) ) {
			\call_user_func( $callback, $data );
		}

		return $data;
	}
}
