<?php
/**
 * Access Token Validation.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

use DateTimeInterface;
use DateTimeImmutable;

/**
 * Access Token Validation.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AccessTokenValidation {
	/**
	 * Expiration time.
	 *
	 * @var \DateTimeInterface
	 */
	private $expiration_time;

	/**
	 * Construct access token validation object.
	 * 
	 * @param DateTimeInterface $expiration_time Expiration time.
	 */
	public function __construct( DateTimeInterface $expiration_time ) {
		$this->expiration_time = $expiration_time;
	}

	/**
	 * Check if the access token is expired.
	 * 
	 * @return bool True if expired, false otherwise.
	 */
	public function is_expired() {
		$now = new DateTimeImmutable();

		return $expiration_time < $now;
	}

	/**
	 * Create access token validation object from a plain object.
	 * 
	 * @return self
	 */
	public function from_object( $object ) {
		$result = new self( new DateTimeImmutable( '@' . $object->exp ) );

		return $result;
	}
}
