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

			foreach ( $element->addresses->address as $element_address ) {
				$address = $customer->new_address();

				$address->set_name( Security::filter( $element_address->name ) );
				$address->set_country( Security::filter( $element_address->country ) );
				$address->set_city( Security::filter( $element_address->city ) );
				$address->set_postcode( Security::filter( $element_address->postcode ) );
				$address->set_telephone( Security::filter( $element_address->telephone ) );
				$address->set_telefax( Security::filter( $element_address->telefax ) );
				$address->set_email( Security::filter( $element_address->email ) );
				$address->set_contact( Security::filter( $element_address->contact ) );
				$address->set_field_1( Security::filter( $element_address->field1 ) );
				$address->set_field_2( Security::filter( $element_address->field2 ) );
				$address->set_field_3( Security::filter( $element_address->field3 ) );
				$address->set_field_4( Security::filter( $element_address->field4 ) );
				$address->set_field_5( Security::filter( $element_address->field5 ) );
				$address->set_field_6( Security::filter( $element_address->field6 ) );
			}

			return $customer;
		}
	}
}
