<?php
/**
 * Search response
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Search response
 *
 * This class represents an Twinfield search response.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SearchResponse {
	/**
	 * The Twinfield search result code.
	 *
	 * @var string
	 */
	private $SearchResult;

	/**
	 * The Twinfield search data.
	 *
	 * @var ArrayOfArrayOfString
	 */
	private $data;

	/**
	 * Get the search response result code.
	 *
	 * @return string
	 */
	public function get_search_result() {
		return $this->SearchResult;
	}

	/**
	 * Get the search response data.
	 *
	 * @return ArrayOfArrayOfString
	 */
	public function get_data() {
		return $this->data;
	}
}
