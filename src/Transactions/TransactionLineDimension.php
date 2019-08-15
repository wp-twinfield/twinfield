<?php
/**
 * Transaction Line
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Transactions;

use Pronamic\WP\Twinfield\CodeName;

/**
 * Transaction Line
 *
 * This class represents a Twinfield transaction line.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionLineDimension extends CodeName {
	/**
	 * The type of this dimension.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Constructs and initialize a Twinfield transaction line.
	 *
	 * @param string      $type      Type.
	 * @param string      $code      Code.
	 * @param string|null $name      Name.
	 * @param string|null $shortname Shortname.
	 */
	public function __construct( $type, $code, $name = null, $shortname = null ) {
		parent::__construct( $code, $name, $shortname );

		$this->type = $type;
	}

	/**
	 * Get the type of this dimension.
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->type;
	}
}
