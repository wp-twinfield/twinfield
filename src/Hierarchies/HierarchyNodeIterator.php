<?php
/**
 * Hierarchy Node Iterator
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Hierarchies;

/**
 * Hierarchy Node Iterator
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 * @link       https://github.com/scotteh/php-dom-wrapper/blob/1.2.0/src/Collections/NodeCollection.php
 */
class HierarchyNodeIterator extends \ArrayIterator implements \RecursiveIterator {
	/**
	 * Get childeren.
	 *
	 * @return HierarchyNodeIterator
	 */
	public function getChildren() {
		$nodes = array();

		if ( $this->valid() ) {
			$nodes = $this->current()->get_child_nodes();
		}

		return new HierarchyNodeIterator( $nodes );
	}

	/**
	 * Has childeren.
	 *
	 * @return bool True if current node has childeren, false otherwise.
	 */
	public function hasChildren() {
		if ( $this->valid() ) {
			return $this->current()->has_child_nodes();
		}

		return false;
	}
}
