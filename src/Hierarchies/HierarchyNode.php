<?php
/**
 * Hierarchy Node
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\Hierarchies;

/**
 * Hierarchy Node
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class HierarchyNode implements \IteratorAggregate {
	/**
	 * Internal id.
	 *
	 * @var int
	 */
	private $id;

	/**
	 * The code of the hierarchy node.
	 *
	 * @var string
	 */
	private $code;

	/**
	 * The name of the hierarchy node.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * The description of the hierarchy node.
	 *
	 * @var string
	 */
	private $description;

	/**
	 * The dimensions linked to the hierarchy node.
	 *
	 * @var HierarchyAccount[]
	 */
	private $accounts;

	/**
	 * The child nodes of the hierarchy node.
	 *
	 * @var array<string, HierarchyNode>
	 */
	private $child_nodes;

	/**
	 * Messages
	 *
	 * @var object|null
	 */
	private $messages;

	/**
	 * The number of times the hierarchy node was changed.
	 *
	 * @var int
	 */
	private $touched;

	/**
	 * Construct hierarchy node.
	 *
	 * @param int    $id          ID.
	 * @param string $code        Code.
	 * @param string $name        Name.
	 * @param string $description Description.
	 */
	public function __construct( $id, $code, $name, $description ) {
		$this->id          = $id;
		$this->code        = $code;
		$this->name        = $name;
		$this->description = $description;
		$this->accounts    = array();
		$this->child_nodes = array();
		$this->touched     = 0;
	}

	/**
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Add account.
	 *
	 * @param HierarchyAccount $account Hierarchy account.
	 */
	public function add_account( HierarchyAccount $account ) {
		$this->accounts[] = $account;
	}

	/**
	 * Get accounts.
	 *
	 * @return HierarchyAccount[]
	 */
	public function get_accounts() {
		return $this->accounts;
	}

	/**
	 * Get accounts recursive.
	 *
	 * @return HierarchyAccount[]
	 */
	public function get_accounts_recursive() {
		$accounts = $this->accounts;

		foreach ( $this->child_nodes as $node ) {
			$child_accounts = $node->get_accounts_recursive();

			$accounts = array_merge( $accounts, $child_accounts );
		}

		return $accounts;
	}

	/**
	 * Has accounts
	 *
	 * @return bool True if node has accounts, false otherwise.
	 */
	public function has_accounts() {
		return \count( $this->accounts ) > 0;
	}

	/**
	 * Add child node.
	 *
	 * @param HierarchyNode $child_node Child node.
	 */
	public function add_child_node( HierarchyNode $child_node ) {
		$this->child_nodes[ $child_node->get_code() ] = $child_node;
	}

	/**
	 * Get child nodes.
	 *
	 * @return array<string, HierarchyNode>
	 */
	public function get_child_nodes() {
		return $this->child_nodes;
	}

	/**
	 * Has child nodes.
	 *
	 * @return bool True if node has child nodes, false otherwise.
	 */
	public function has_child_nodes() {
		return \count( $this->child_nodes ) > 0;
	}

	/**
	 * Get child nodes recursive.
	 *
	 * @return array<string, HierarchyNode>
	 */
	public function get_child_nodes_recursive() {
		$nodes = array();

		foreach ( $this->child_nodes as $node ) {
			$nodes[ $node->get_code() ] = $node;

			$nodes = array_merge( $nodes, $node->get_child_nodes_recursive() );
		}

		return $nodes;
	}

	/**
	 * Get iterator.
	 *
	 * @return HierarchyNodeIterator
	 */
	public function getIterator() {
		return new HierarchyNodeIterator( $this->child_nodes );
	}

	/**
	 * String.
	 *
	 * @return string
	 */
	public function __toString() {
		return \sprintf(
			'%s - %s',
			$this->code,
			$this->name
		);
	}

	/**
	 * Convert from object.
	 *
	 * @param object $object Object.
	 * @return Hierarchy
	 */
	public static function from_object( $object ) {
		$hierarchy = new HierarchyNode( $object->Id, $object->Code, $object->Name, $object->Description );

		/**
		 * Accounts.
		 */
		$accounts = $object->Accounts->HierarchyAccount;

		if ( is_object( $accounts ) ) {
			$accounts = array( $accounts );
		}

		foreach ( $accounts as $o ) {
			$hierarchy->add_account( HierarchyAccount::from_object( $o ) );
		}

		/**
		 * Child nodes.
		 */
		$child_nodes = $object->ChildNodes->HierarchyNode;

		if ( is_object( $child_nodes ) ) {
			$child_nodes = array( $child_nodes );
		}

		foreach ( $child_nodes as $o ) {
			$hierarchy->add_child_node( HierarchyNode::from_object( $o ) );
		}

		/**
		 * Done.
		 */
		return $hierarchy;
	}
}
