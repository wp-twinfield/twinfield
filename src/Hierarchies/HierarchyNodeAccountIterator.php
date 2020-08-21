<?php
/**
 * Hierarchy Node Account Iterator
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Hierarchies;

/**
 * Hierarchy Node Account Iterator
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 * @link       https://github.com/scotteh/php-dom-wrapper/blob/1.2.0/src/Collections/NodeCollection.php
 */
class HierarchyNodeAccountIterator extends \ArrayIterator implements \RecursiveIterator {
	/**
	 * Get childeren.
	 *
	 * @return HierarchyNodeIterator
	 */
	public function getChildren() {
		$items = array();

		if ( $this->valid() ) {
			$items = array_merge( $items, $this->current()->get_accounts() );

			$items = array_merge( $items, $this->current()->get_child_nodes() );
		}

		return new HierarchyNodeAccountIterator( $items );
	}

	/**
	 * Has childeren.
	 *
	 * @return bool True if current node has childeren, false otherwise.
	 */
	public function hasChildren() {
		if ( $this->valid() ) {
			return $this->current()->has_child_nodes() || $this->current()->has_accounts();
		}

		return false;
	}
}
