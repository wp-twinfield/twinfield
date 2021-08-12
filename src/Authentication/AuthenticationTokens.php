<?php
/**
 * Authentication Tokens.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

use DateTimeInterface;
use DateTimeImmutable;
use JsonSerializable;

/**
 * Authentication Tokens.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AuthenticationTokens implements JsonSerializable {
	/**
	 * Access Token.
	 *
	 * @var string
	 */
	private $access_token;

	/**
	 * Token Type.
	 *
	 * @var string
	 */
	private $token_type;

	/**
	 * Refresh Token.
	 *
	 * @var string
	 */
	private $refresh_token;

	/**
	 * Construct access token.
	 */
	public function __construct( $access_token, $token_type, $refresh_token ) {
		$this->access_token  = $access_token;
		$this->token_type    = $token_type;
		$this->refresh_token = $refresh_token;
	}

	public function get_access_token() {
		return $this->access_token;
	}

	public function get_refresh_token() {
		return $this->refresh_token;
	}

	public function jsonSerialize() {
		return (object) array(
			'access_token'  => $this->access_token,
			'token_type'    => $this->token_type,
			'refresh_token' => $this->refresh_token,
		);
	}

	/**
	 * Create access token validation object from a plain object.
	 * 
	 * @return self
	 */
	public function from_object( $object ) {
		return new self( $object->access_token, $object->token_type, $object->refresh_token );
	}
}
