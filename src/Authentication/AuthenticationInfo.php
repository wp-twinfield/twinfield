<?php
/**
 * Authentication info.
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Authentication;

use \SoapHeader;

/**
 * Authentication info.
 *
 * This class contains constants for different Twinfield browse codes.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class AuthenticationInfo {
	/**
	 * Cluster.
	 *
	 * @var string
	 */
	private $cluster;

	/**
	 * SOAP header.
	 *
	 * @var SoapHeader
	 */
	private $soap_header;

	/**
	 * Construct an authentication info object.
	 *
	 * @param string     $cluster     Cluster.
	 * @param SoapHeader $soap_header SOAP Header.
	 */
	public function __construct( $cluster, SoapHeader $soap_header ) {
		$this->cluster     = $cluster;
		$this->soap_header = $soap_header;
	}

	/**
	 * Get cluster.
	 *
	 * @return string
	 */
	public function get_cluster() {
		return $this->cluster;
	}

	/**
	 * Get SOAP hader.
	 *
	 * @return SoapHeader
	 */
	public function get_soap_header() {
		return $this->soap_header;
	}
}
