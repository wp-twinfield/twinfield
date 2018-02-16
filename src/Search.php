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
	private $firstRow; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Maximum number of rows to return, usefull for paging.
	 *
	 * @var int
	 */
	private $maxRows; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.MemberNotSnakeCase -- Twinfield vaiable name.

	/**
	 * Options.
	 *
	 * @var ArrayOfArrayOfString
	 */

	/**
	 * Constructs and initializes an Twinfield search object.
	 *
	 * @param string $type      Finder type, see Finder type.
	 * @param string $pattern   The search pattern. May contain wildcards * and ?.
	 * @param int    $field     Fields to search through, see Search fields.
	 * @param int    $first_row First row to return, usefull for paging.
	 * @param int    $max_rows  Maximum number of rows to return, usefull for paging.
	 * @param array  $options   The options.
	 */
	public function __construct( $type, $pattern, $field, $first_row, $max_rows, $options = array() ) {
		$this->type     = $type;
		$this->pattern  = $pattern;
		$this->field    = $field;
		$this->firstRow = $first_row; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$this->maxRows  = $max_rows; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar -- Twinfield vaiable name.
		$this->options  = ArrayOfArrayOfString::parse_array( $options );
	}
}
