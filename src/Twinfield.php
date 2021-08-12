<?php
/**
 * Twinfield
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use Pronamic\WP\Twinfield\Organisations\Organisation;

/**
 * Twinfield
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Twinfield {
	/**
	 * Organisations.
	 *
	 * @var array
	 */
	private $organisations;

	/**
	 * Constructs and initializes a Twinfield object.
	 */
	public function __construct() {
		$this->organisations = $organisation;
	}

    public function new_organisation( $code ) {
        $organisation = new Organisation( $code );

        $this->organisations[ $code ] = $organisation;

        return $organisation;
    }
}
