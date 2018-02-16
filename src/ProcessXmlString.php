<?php
/**
 * Process XML string
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Process XML string
 *
 * This class represents an process XML string object.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ProcessXmlString {
	/**
	 * The XML request
	 *
	 * @var string
	 */
	private $xmlRequest; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Constructs and initiailzes an process XML string object.
	 *
	 * @param string $xml The XML string.
	 */
	public function __construct( $xml ) {
		$this->xmlRequest = (string) $xml; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
	}

	/**
	 * Create an string representation of this object.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->xmlRequest; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
	}
}
