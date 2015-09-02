<?php
/**
 * Customer unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML/Articles
 */

namespace Pronamic\WP\Twinfield\XML\Customers;

use Pronamic\WP\Twinfield\DimensionTypes;
use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\Customers\Customer;

/**
 * Sales invoices unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerUnserializer extends Unserializer {
	/**
	 * Unserialize the specified XML to an article.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'dimension' === $element->getName() && DimensionTypes::DEB === Security::filter( $element->type ) ) {
			$customer = new Customer();

			$customer->set_office( Security::filter( $element->office ) );
			$customer->set_code( Security::filter( $element->code ) );
			$customer->set_name( Security::filter( $element->name ) );
			$customer->set_shortname( Security::filter( $element->shortname ) );

			return $customer;
		}
	}
}
