<?php
/**
 * VAT Code
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

/**
 * VAT Code
 *
 * This class represents an  to the Twinfield VAT code.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class VatCode extends CodeName {
	/**
	 * Type.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Construct a VAT code object.
	 *
	 * @param string      $code      Code.
	 * @param string|null $name      Name.
	 * @param string|null $shortname Shortname.
	 * @param string|null $type      Type.
	 */
	public function __construct( $code, $name = null, $shortname = null, $type = null ) {
		parent::__construct( $code, $name, $shortname );

		$this->set_type( $type );
	}

	/**
	 * Get type.
	 *
	 * @return string|null
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Set type.
	 *
	 * @param string|null $type The type.
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}
}
