<?php
/**
 * General Ledger Finder
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/GeneralLedger
 */

namespace Pronamic\WP\Twinfield\GeneralLedger;

use Pronamic\WP\Twinfield\Finder;
use Pronamic\WP\Twinfield\FinderTypes;
use Pronamic\WP\Twinfield\Search;
use Pronamic\WP\Twinfield\SearchFields;

/**
 * General Ledger Finder
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class GeneralLedgerFinder {
	/**
	 * The finder wich is used to connect with Twinfield.
	 *
	 * @var Finder
	 */
	private $finder;

	/**
	 * Constructs and initializes an custom finder object.
	 *
	 * @param Finder $finder The finder.
	 */
	public function __construct( Finder $finder ) {
		$this->finder = $finder;
	}

	/**
	 * Find general ledger.
	 *
	 * @param string $pattern   The pattern.
	 * @param string $field     The field.
	 * @param int    $first_row The first row.
	 * @param int    $max_rows  The max rows.
	 * @return array
	 */
	public function get_general_ledger( $pattern, $field, $first_row, $max_rows ) {
		$general_ledger = array();

		// Request.
		$search = new Search(
			FinderTypes::DIM,
			$pattern,
			$field,
			$first_row,
			$max_rows
		);

		$response = $this->finder->search( $search );

		// Parse.
		if ( ! $response ) {
			return false;
		}

		if ( ! $response->is_successful() ) {
			return false;
		}

		$data = $response->get_data();

		$items = $data->get_items();

		if ( ! is_null( $items ) ) {
			foreach ( $items as $item ) {
				$general_ledger[] = $item;
			}
		}

		return $general_ledger;
	}
}
