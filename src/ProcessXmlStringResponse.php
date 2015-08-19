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
	 * Ok Log-on successful.
	 *
	 * @var string
	 */
	private $ProcessXmlStringResult;

	/**
	 * Get the result from thhis process XML string response object
	 *
	 * @return string An XML string.
	 */
	public function get_result() {
		return $this->ProcessXmlStringResult;
	}
}
