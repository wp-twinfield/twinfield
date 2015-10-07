<?php
/**
 * Supplier unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML/Articles
 */

namespace Pronamic\WP\Twinfield\XML\Suppliers;

use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\Suppliers\Supplier;

/**
 * Sales invoices unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SupplierUnserializer extends Unserializer {
	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement $element The XML element to unserialize.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'dimension' === $element->getName() && DimensionTypes::CRD === Security::filter( $element->type ) ) {
			$supplier = new Supplier();

			$supplier->set_office( Security::filter( $element->office ) );
			$supplier->set_code( Security::filter( $element->code ) );
			$supplier->set_name( Security::filter( $element->name ) );
			$supplier->set_shortname( Security::filter( $element->shortname ) );

			return $supplier;
		}
	}
}
