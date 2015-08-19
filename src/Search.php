<?php
/**
 * Search
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * Search
 *
 * This class represents an Twinfield search request.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Search {
	/**
	 * Finder type, see Finder type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * The search pattern. May contain wildcards * and ?.
	 *
	 * @var string
	 */
	private $pattern;

	/**
	 * Fields to search through, see Search fields.
	 *
	 * @var int
	 */
	private $field;

	/**
	 * First row to return, usefull for paging.
	 *
	 * @var int
	 */
	private $firstRow;

	/**
	 * Maximum number of rows to return, usefull for paging.
	 *
	 * @var int
	 */
	private $maxRows;

	/**
	 * Constructs and initializes an Twinfield search object.
	 *
	 * @param string $type             Finder type, see Finder type.
	 * @param string $pattern          The search pattern. May contain wildcards * and ?.
	 * @param int    $field            Fields to search through, see Search fields.
	 * @param int    $first_row        First row to return, usefull for paging.
	 * @param int    $max_rows         Maximum number of rows to return, usefull for paging.
	 */
	public function __construct( $type, $pattern, $field, $first_row, $max_rows ) {
		$this->type     = $type;
		$this->pattern  = $pattern;
		$this->field    = $field;
		$this->firstRow = $first_row;
		$this->maxRows  = $max_rows;
	}
}
