<?php
/**
 * Sales invoice serializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\SalesInvoices;

use Pronamic\WP\Twinfield\XML\Serializer;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoice;

/**
 * Sales invoice serializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceSerializer extends Serializer {
	/**
	 * Constructs and initialize an article read request XML object
	 */
	public function __construct( SalesInvoice $sales_invoice ) {
		parent::__construct();

		$root = $this->document->createElement( 'salesinvoice' );

		$this->document->appendChild( $root );

		// Header
		$header = $sales_invoice->get_header();

		$header_elemnt = $this->document->createElement( 'header' );
		
		$root->appendChild( $header_elemnt );

		$elements = array(
			'invoicetype'   => $header->get_type(),
			'customer'      => $header->get_customer(),
			'status'        => $header->get_status(),
			'paymentmethod' => $header->get_payment_method(),
		);

		foreach ( $elements as $name => $value ) {
			$element = $this->document->createElement( $name );
			$element->appendChild( new \DOMText( $value ) );

			$header_elemnt->appendChild( $element );
		}

		// Lines
		$lines_element = $this->document->createElement( 'lines' );
		
		$root->appendChild( $lines_element );

		foreach ( $sales_invoice->get_lines() as $line ) {
			$line_element = $this->document->createElement( 'line' );

			$lines_element->appendChild( $line_element );

			$elements = array(
				'quantity'    => $line->get_quantity(),
				'article'     => $line->get_article(),
				'description' => $line->get_description(),
				'valueexcl'   => $line->get_value_excl(),
				'freetext1'   => $line->get_free_text_1(),
				'freetext2'   => $line->get_free_text_2(),
				'freetext3'   => $line->get_free_text_3(),
			);

			foreach ( $elements as $name => $value ) {
				$element = $this->document->createElement( $name );
				$element->appendChild( new \DOMText( $value ) );

				$line_element->appendChild( $element );
			}
		}
	}
}
