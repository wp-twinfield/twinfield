<?php
/**
 * Authentication strategy.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

/**
 * Authentication strategy.
 *
 * This class contains constants for different Twinfield browse codes.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
abstract class AuthenticationStrategy {
	/**
	 * Login.
	 */
	abstract public function login();

	/**
	 * Get the SOAP Header for authentication.
	 *
	 * @return \SoapHeader
	 */
	abstract public function get_soap_header();

	/**
	 * Get the cluster.
	 *
	 * @return string
	 */
	abstract public function get_cluster();
}
