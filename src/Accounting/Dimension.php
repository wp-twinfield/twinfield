<?php
/**
 * Dimension
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Accounting;

use Pornamic\WP\Twinfield\Offices\Office;
use DOMDocument;

/**
 * Dimension
 *
 * This class represents a Twinfield dimension.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Dimension {
	private $type;

	private $code;

	public function __construct( DimensionType $type, $code ) {
		$this->type   = $type;
		$this->code   = $code;
	}

	public function get_code() {
		return $this->code;
	}
}
