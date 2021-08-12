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
use JsonSerializable;
use Pronamic\WP\Twinfield\Organisations\Organisation;
use Pronamic\WP\Twinfield\Users\User;

/**
 * Access Token Validation.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AccessTokenValidation implements JsonSerializable {
	/**
	 * Expiration timestamp.
	 *
	 * @var int
	 */
	private $expiration;

	/**
	 * Construct access token validation object.
	 * 
	 * @param int    $expiration  Expiration timestamp.
	 * @param User   $user        User.
	 * @param string $cluster_url Cluster URL.
	 */
	public function __construct( $expiration, User $user, $cluster_url ) {
		$this->expiration  = $expiration;
		$this->user        = $user;
		$this->cluster_url = $cluster_url;
	}

	/**
	 * Check if the access token is expired.
	 * 
	 * @return bool True if expired, false otherwise.
	 */
	public function is_expired() {
		return $this->expiration < \time();
	}

	/**
	 * Get user.
	 * 
	 * @return User
	 */
	public function get_user() {
		return $this->user;
	}

	/**
	 * Get cluster URL.
	 * 
	 * @return User
	 */
	public function get_cluster_url() {
		return $this->cluster_url;
	}

	/**
	 * JSON serialize.
	 * 
	 * @return object
	 */
	public function jsonSerialize() {
		return (object) array(
			'exp'                      => $this->expiration,
			'twf.organisationCode'     => $this->user->get_organisation()->get_code(),
			'twf.organisationId'       => $this->user->get_organisation()->get_uuid(),
			'twf.organisationUserCode' => $this->user->get_code(),
			'twf.clusterUrl'           => $this->cluster_url,
		);
	}

	/**
	 * Create access token validation object from a plain object.
	 * 
	 * @param object $object Object.
	 * @return self
	 */
	public function from_object( $object ) {
		$organisation = new Organisation( $object->{'twf.organisationCode'} );
		$organisation->set_uuid( $object->{'twf.organisationId'} );

		$user = $organisation->new_user( $object->{'twf.organisationUserCode'} );

		$cluster_url = $object->{'twf.clusterUrl'};

		$result = new self( $object->exp, $user, $cluster_url );

		return $result;
	}
}
