<?php
/**
 * Process XML string response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Process XML string response
 *
 * This class represents an process XML string response.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ProcessXmlStringResponse {
	/**
	 * Process XML string result.
	 *
	 * @var string
	 */
	private $ProcessXmlStringResult; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Get the result from thhis process XML string response object
	 *
	 * @return string An XML string.
	 */
	public function get_result() {
		return $this->ProcessXmlStringResult; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
	}

	/**
	 * Create a string representation of this process XML string repsonse object.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->get_result();
	}
}
