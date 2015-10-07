<?php
/**
 * Dimension unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML/Articles
 */

namespace Pronamic\WP\Twinfield\XML\Dimensions;

use Pronamic\WP\Twinfield\DimensionTypes;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Customers\CustomerUnserializer;
use Pronamic\WP\Twinfield\XML\Suppliers\SupplierUnserializer;

/**
 * Dimension unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class DimensionUnserializer extends Unserializer {
	/**
	 * Constructs and initializes dimension unserialzier.
	 */
	public function __construct() {
		$this->unserializers = array(
			DimensionTypes::DEB => new CustomerUnserializer(),
			DimensionTypes::CRD => new SupplierUnserializer(),
		);
	}

	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement $element the element to unserialize.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'dimension' === $element->getName() ) {
			$type = Security::filter( $element->type );

			if ( isset( $this->unserializers[ $type ] ) ) {
				$unserializer = $this->unserializers[ $type ];

				return $unserializer->unserialize( $element );
			}
		}
	}
}
