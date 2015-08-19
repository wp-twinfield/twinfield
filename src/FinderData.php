<?php
/**
 * Finder data
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Finder data
 *
 * The FinderData class is a container for the search results.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class FinderData {
	/**
	 * The total number of search results.
	 *
	 * @var int
	 */
	private $TotalRows;

	/**
	 * The column names.
	 *
	 * @var ArrayOfString
	 */
	private $Columns;

	/**
	 * The requested data items.
	 *
	 * @var ArrayOfArrayOfString
	 */
	private $Items;

	/**
	 * Get the total number of search results.
	 *
	 * @return int
	 */
	public function get_total_rows() {
		return $this->TotalRows;
	}

	/**
	 * Get the column names.
	 *
	 * @return ArrayOfString
	 */
	public function get_columns() {
		return $this->Columns;
	}

	/**
	 * Get the requested data items.
	 *
	 * @return ArrayOfArrayOfString
	 */
	public function get_items() {
		return $this->Items;
	}
}
