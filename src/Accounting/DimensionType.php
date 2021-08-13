<?php
/**
 * Dimension Type
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Transactions
 */

namespace Pronamic\WP\Twinfield\Accounting;

/**
 * Dimension Type
 *
 * This class represents a Twinfield dimension.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DimensionType {
    private $office;

	private $code;

    private $dimensions = array();

	public function __construct( $office, $code ) {
        $this->office = $office;
		$this->code   = $code;
	}

    public function new_dimension( $code ) {
        $dimension = new Dimension( $this, $code );

        $this->dimensions[] = $dimension;

        return $dimension;
    }
}
