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
	 * Constructs and initialize an article read request XML object.
	 *
	 * @param SalesInvoice $sales_invoice the sales invoice to serialize.
	 */
	public function __construct( SalesInvoice $sales_invoice ) {
		parent::__construct();

		$root = $this->document->createElement( 'salesinvoice' );

		$this->document->appendChild( $root );

		// Header.
		$header = $sales_invoice->get_header();

		$header_elemnt = $this->document->createElement( 'header' );

		$root->appendChild( $header_elemnt );

		$elements = array(
			'invoicetype'   => $header->get_type(),
			'customer'      => $header->get_customer(),
			'status'        => $header->get_status(),
			'paymentmethod' => $header->get_payment_method(),
			'headertext'    => $header->get_header_text(),
			'footertext'    => $header->get_footer_text(),
		);

		foreach ( $elements as $name => $value ) {
			$element = $this->document->createElement( $name );
			$element->appendChild( new \DOMText( $value ) );

			$header_elemnt->appendChild( $element );
		}

		// Lines.
		$lines_element = $this->document->createElement( 'lines' );

		$root->appendChild( $lines_element );

		foreach ( $sales_invoice->get_lines() as $line ) {
			$line_element = $this->document->createElement( 'line' );

			$lines_element->appendChild( $line_element );

			$elements = array(
				'quantity'        => $line->get_quantity(),
				'article'         => $line->get_article(),
				'subarticle'      => $line->get_subarticle(),
				'units'           => $line->get_units(),
				'vatcode'         => $line->get_vat_code(),
				'description'     => $line->get_description(),
				'unitspriceexcl'  => $line->get_units_price_excl(),
				'valueexcl'       => $line->get_value_excl(),
				'freetext1'       => $line->get_free_text_1(),
				'freetext2'       => $line->get_free_text_2(),
				'freetext3'       => $line->get_free_text_3(),
				'performancetype' => $line->get_performance_type(),
			);

			$performance_date = $line->get_performance_date();

			if ( ! empty( $performance_date ) ) {
				$elements['performancedate'] = $performance_date->format( 'Ymd' );
			}

			$elements = array_filter( $elements );

			foreach ( $elements as $name => $value ) {
				$element = $this->document->createElement( $name );
				$element->appendChild( new \DOMText( $value ) );

				$line_element->appendChild( $element );
			}
		}
	}
}
