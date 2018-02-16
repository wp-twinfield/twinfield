<?php
/**
 * Message of error codes
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Message of error codes
 *
 * This class represents the 'MessageOfErrorCodes' Twinfield class.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class MessageOfErrorCodes {
	/**
	 * Type of error.
	 *
	 * @var string
	 */
	private $Type; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Text of error
	 *
	 * @var string
	 */
	private $Text; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Code of error
	 *
	 * @var string
	 */
	private $Code; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Parameters of error
	 *
	 * @var ArrayOfString
	 */
	private $Parameters; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.
}
