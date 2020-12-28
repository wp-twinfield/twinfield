<?php
/**
 * Get budget totals result.
 *
 * @since	  1.0.0
 *
 * @package	Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Budget;

use Pronamic\WP\Twinfield\Query;
use Pronamic\WP\Twinfield\Hierarchies\HierarchyNode;
use Pronamic\WP\Twinfield\Hierarchies\HierarchyNodeAccountIterator;

/**
 * Get budget totals result.
 *
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Masters/Budget
 * @since 1.0.0
 * @package Pronamic/WP/Twinfield
 * @author Remco Tolsma <info@remcotolsma.nl>
 */
class GetBudgetTotalsResult implements \Countable, \IteratorAggregate {
	/**
	 * Get budget totals.
	 *
	 * @return GetBudgetTotalResult[]
	 */
	public function get_budget_totals() {
		if ( \property_exists( $this->BudgetTotals, 'GetBudgetTotalResult' ) ) {
			$result = $this->BudgetTotals->GetBudgetTotalResult;

			if ( \is_array( $result ) ) {
				return $result;
			}

			return array( $result );
		}

		return array();
	}

	/**
	 * Get budget by hierarchy node.
	 *
	 * @param HierarchyNode $node Hierarchy node.
	 * @return GetBudgetTotalResult[]
	 */
	public function get_budget_totals_by_hierarchy_node( HierarchyNode $node ) {
		$budget_totals = $this->get_budget_totals();

		$budget_totals = \array_filter( $budget_totals, function( $budget_total ) use( $node ) {
			return $budget_total->is_party_of_hierarchy_node( $node );
		} );

		return $budget_totals;
	}

	/**
	 * Get iterator.
	 *
	 * @return \ArrayIterator<int, GetBudgetTotalResult>
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->get_budget_totals() );
	}

	/**
	 * Count budget results.
	 *
	 * @return int
	 */
	public function count() {
		return \count( $this->get_budget_totals() );
	}
}
