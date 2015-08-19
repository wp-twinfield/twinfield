<?php
/**
 * Session
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Session
 *
 * This class represents an Twinfield session.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Session {
	/**
	 * The unique ID of this session.
	 *
	 * @var string
	 */
	private $id;

	/**
	 * The cluster URL to use for this session.
	 *
	 * @var string
	 */
	private $cluster;

	/**
	 * Constructs and initializes an session object.
	 *
	 * @param string $id      The Twinfield session ID.
	 * @param string $cluster The Twinfield cluster URL.
	 */
	public function __construct( $id, $cluster ) {
		$this->id      = $id;
		$this->cluster = $cluster;
	}

	/**
	 * Get the session ID.
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Get the cluster URL for this session.
	 *
	 * @return string
	 */
	public function get_cluster() {
		return $this->cluster;
	}
}
