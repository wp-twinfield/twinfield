<?php
/**
 * Customer serializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\Customers;

use Pronamic\WP\Twinfield\DimensionTypes;
use Pronamic\WP\Twinfield\XML\Serializer;
use Pronamic\WP\Twinfield\Customers\Customer;

/**
 * Sales invoice serializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerSerializer extends Serializer {
	/**
	 * Constructs and initialize an article read request XML object.
	 *
	 * @param Customer $customer the customer to serialize.
	 */
	public function __construct( Customer $customer ) {
		parent::__construct();

		$root = $this->document->createElement( 'dimension' );

		$this->document->appendChild( $root );

		$elements = array(
			'office'    => $customer->get_office(),
			'type'      => DimensionTypes::DEB,
			'name'      => $customer->get_name(),
			'shortname' => $customer->get_shortname(),
		);

		foreach ( $elements as $name => $value ) {
			$element = $this->document->createElement( $name );
			$element->appendChild( new \DOMText( $value ) );

			$root->appendChild( $element );
		}
	}
}
