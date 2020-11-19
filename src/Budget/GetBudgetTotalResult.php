<?php
/**
 * Get budget total result.
 *
 * @since 1.0.0
 * @package Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Budget;

use Pronamic\WP\Twinfield\Query;
use Pronamic\WP\Twinfield\Hierarchies\HierarchyNode;

/**
 * Get budget total result.
 *
 * @link https://accounting.twinfield.com/webservices/documentation/#/ApiReference/Masters/Budget
 * @since 1.0.0
 * @package Pronamic/WP/Twinfield
 * @author Remco Tolsma <info@remcotolsma.nl>
 */
class GetBudgetTotalResult {
	/**
	 * Get year.
	 *
	 * @return int
	 */
	public function get_year() {
		return $this->Year;
	}

	/**
	 * Get period.
	 *
	 * @return int
	 */
	public function get_period() {
		return $this->Period;
	}

	/**
	 * Get budget total.
	 *
	 * @return float
	 */
	public function get_budget_total() {
		return \floatval( $this->BudgetTotal );
	}

	/**
	 * Get dimension 1 code.
	 *
	 * @return string
	 */
	public function get_dimension_1_code() {
		return $this->Dim1;
	}

	/**
	 * Get dimension 2 code.
	 *
	 * @return string
	 */
	public function get_dimension_2_code() {
		return $this->Dim2;
	}

	/**
	 * Get dimension 3 code.
	 *
	 * @return string
	 */
	public function get_dimension_3_code() {
		return $this->Dim3;
	}

	/**
	 * Get group 1 code.
	 *
	 * @return string
	 */
	public function get_group_1_code() {
		return $this->Group1;
	}

	/**
	 * Get group 2 code.
	 *
	 * @return string
	 */
	public function get_group_2_code() {
		return $this->Group2;
	}

	/**
	 * Get group 3 code.
	 *
	 * @return string
	 */
	public function get_group_3_code() {
		return $this->Group3;
	}

	/**
	 * Check if this budget total result is part of the specified hierachy node.
	 *
	 * @param HierarchyNode $node Node.
	 * @return boolean True if is part, false otherwise.
	 */
	public function is_party_of_hierarchy_node( $node ) {
		$group_code = $node->get_code();

		$is_part_of_group_code = $this->is_part_of_group_code( $node->get_code() );

		if ( $is_part_of_group_code ) {
			return true;
		}

		foreach ( $node->get_accounts() as $account ) {
			$is_part_of_dimension_code = $this->is_part_of_dimension_code( $account->get_code() );

			if ( $is_part_of_dimension_code ) {
				return true;
			}
		}

		foreach ( $node->get_child_nodes() as $child_node ) {
			$is_part_of_child_node = $this->is_party_of_hierarchy_node( $child_node );

			if ( $is_part_of_child_node ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if this budget total result is part of the specified group code.
	 *
	 * @param string $code Group code.
	 * @return boolean True if is part, false otherwise.
	 */
	public function is_part_of_group_code( $code ) {
		if ( $code === $this->get_group_1_code() ) {
			return true;
		}

		if ( $code === $this->get_group_2_code() ) {
			return true;
		}

		if ( $code === $this->get_group_3_code() ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if this budget total result is part of the specified dimension code.
	 *
	 * @param string $code Dimension code.
	 * @return boolean True if is part, false otherwise.
	 */
	public function is_part_of_dimension_code( $code ) {
		if ( $code === $this->get_dimension_1_code() ) {
			return true;
		}

		if ( $code === $this->get_dimension_2_code() ) {
			return true;
		}

		if ( $code === $this->get_dimension_3_code() ) {
			return true;
		}

		return false;
	}
}
