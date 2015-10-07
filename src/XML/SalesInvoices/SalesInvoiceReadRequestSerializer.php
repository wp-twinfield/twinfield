<?php
/**
 * Sales invoice read request XML
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\SalesInvoices;

use Pronamic\WP\Twinfield\XML\ReadRequestSerializer;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceReadRequest;

/**
 * Sales invoice read request XML
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceReadRequestSerializer extends ReadRequestSerializer {
	/**
	 * Constructs and initialize an article read request XML object
	 *
	 * @param SalesInvoiceReadRequest $request the sales invoice read request to serialize.
	 */
	public function __construct( SalesInvoiceReadRequest $request ) {
		parent::__construct();

		$root = $this->document->createElement( 'read' );

		$this->document->appendChild( $root );

		$elements = array(
			'type'          => $request->get_type(),
			'office'        => $request->get_office(),
			'code'          => $request->get_code(),
			'invoicenumber' => $request->get_invoice_number(),
		);

		foreach ( $elements as $name => $value ) {
			$element = $this->document->createElement( $name );
			$element->appendChild( new \DOMText( $value ) );

			$root->appendChild( $element );
		}
	}
}
