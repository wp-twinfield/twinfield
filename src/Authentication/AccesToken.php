<?php
/**
 * Access Token.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

use DateTimeInterface;
use DateTimeImmutable;

/**
 * Access Token.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AccessToken {
	/**
	 * Created timestamp.
	 *
	 * @var int
	 */
	private $created;

	/**
	 * Construct access token.
	 */
	public function __construct() {
		$this->created_at = \time();
	}

	/**
	 * Check if the access token is expired.
	 * 
	 * @link https://github.com/googleapis/google-api-php-client/blob/11871e94006ce7a419bb6124d51b6f9ace3f679b/src/Client.php#L525-L555
	 * @return bool True if expired, false otherwise.
	 */
	public function is_expired() {
		return ( $this->created_at + $this->expires_in - 30 ) < \time();
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
