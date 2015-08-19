<?php
/**
 * Select company response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Select company response
 *
 * This class contains represents an Twinfield select company response.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SelectCompanyResponse {
	/**
	 * Select company result code
	 *
	 * @var string
	 */
	private $SelectCompanyResult;

	/**
	 * Get the Twinfield result code for this response
	 *
	 * @return string
	 */
	public function get_result() {
		return $this->SelectCompanyResult;
	}
}
