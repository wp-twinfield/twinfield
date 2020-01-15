<?php
/**
 * Sales invoices unserializer
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/XML/Articles
 */

namespace Pronamic\WP\Twinfield\XML\SalesInvoices;

use Pronamic\WP\Twinfield\XML\Security;
use Pronamic\WP\Twinfield\XML\Unserializer;
use Pronamic\WP\Twinfield\XML\DateUnserializer;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoice;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceHeader;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceLine;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceResponse;
use Pronamic\WP\Twinfield\VatCode;

/**
 * Sales invoices unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceUnserializer extends Unserializer {
	/**
	 * Constructs and initializes an sales invoice unserializer.
	 */
	public function __construct() {
		$this->date_unserializer = new DateUnserializer();
	}

	/**
	 * Get inner XML of DOMNode.
	 *
	 * @link https://www.php.net/manual/en/domdocument.savexml.php
	 * @link https://stackoverflow.com/questions/2087103/how-to-get-innerhtml-of-domnode
	 * @param \DOMNode $node DOM node.
	 * @return string
	 */
	private function get_inner_xml( \DOMNode $node = null ) {
		if ( null === $node ) {
			return null;
		}

		$child_nodes_array = \iterator_to_array( $node->childNodes );

		$child_nodes_xml = array_map( function( $node ) {
			return $node->ownerDocument->saveXML( $node );
		}, $child_nodes_array );

		$inner_xml = implode( $child_nodes_xml );

		return $inner_xml;
	}

	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement $element The XML element to unserialize.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'salesinvoice' === $element->getName() ) {
			$sales_invoice = new SalesInvoice();

			$header = $sales_invoice->get_header();

			$dom_header = \dom_import_simplexml( $element->header );

			if ( $element->header ) {
				$header->set_office( Security::filter( $element->header->office ) );
				$header->set_type( Security::filter( $element->header->invoicetype ) );
				$header->set_number( Security::filter( $element->header->invoicenumber ) );
				$header->set_date( $this->date_unserializer->unserialize( $element->header->invoicedate ) );
				$header->set_due_date( $this->date_unserializer->unserialize( $element->header->duedate ) );
				$header->set_bank( Security::filter( $element->header->bank ) );
				$header->set_customer( Security::filter( $element->header->customer ) );
				$header->set_status( Security::filter( $element->header->status ) );

				/**
				 * Header and footer text can container <br /> elements.
				 *
				 * @link https://stackoverflow.com/questions/4145424/getting-the-xml-content-of-a-simplexmlelement
				 */
				$header->set_header_text( Security::filter( $this->get_inner_xml( $dom_header->getElementsByTagName( 'headertext' )->item( 0 ) ) ) );
				$header->set_footer_text( Security::filter( $this->get_inner_xml( $dom_header->getElementsByTagName( 'footertext' )->item( 0 ) ) ) );

				$header->set_invoice_address_number( Security::filter( $element->header->invoiceaddressnumber, FILTER_VALIDATE_INT ) );
				$header->set_deliver_address_number( Security::filter( $element->header->deliveraddressnumber, FILTER_VALIDATE_INT ) );
			}

			if ( $element->lines ) {
				foreach ( $element->lines->line as $element_line ) {
					$line = $sales_invoice->new_line();

					$line->set_id( Security::filter( $element_line['id'] ) );
					$line->set_article( Security::filter( $element_line->article ) );
					$line->set_subarticle( Security::filter( $element_line->subarticle ) );
					$line->set_quantity( Security::filter( $element_line->quantity ) );
					$line->set_units( Security::filter( $element_line->units ) );
					$line->set_allow_discount_or_premium( Security::filter( $element_line->units, FILTER_VALIDATE_BOOLEAN ) );
					$line->set_description( Security::filter( $element_line->description ) );
					$line->set_value_excl( Security::filter( $element_line->valueexcl, FILTER_VALIDATE_FLOAT ) );
					$line->set_vat_value( Security::filter( $element_line->vatvalue, FILTER_VALIDATE_FLOAT ) );
					$line->set_value_inc( Security::filter( $element_line->valueinc, FILTER_VALIDATE_FLOAT ) );
					$line->set_free_text_1( Security::filter( $element_line->freetext1 ) );
					$line->set_free_text_2( Security::filter( $element_line->freetext2 ) );
					$line->set_free_text_3( Security::filter( $element_line->freetext3 ) );
					$line->set_performance_type( Security::filter( $element_line->performancetype ) );
					$line->set_performance_date( $this->date_unserializer->unserialize( $element_line->performancedate ) );
				}
			}

			if ( $element->vatlines ) {
				foreach ( $element->vatlines->vatline as $element_line ) {
					$vat_line = $sales_invoice->new_vat_line();

					// VAT code.
					$vat_code = new VatCode(
						Security::filter( $element_line->vatcode ),
						Security::filter( $element_line->vatcode['name'] ),
						Security::filter( $element_line->vatcode['shortname'] )
					);

					$vat_line->set_vat_code( $vat_code );

					$vat_line->set_vat_value( Security::filter( $element_line->vatvalue, FILTER_VALIDATE_FLOAT ) );
				}
			}

			if ( $element->totals ) {
				$totals = $sales_invoice->get_totals();

				$totals->set_value_excl( Security::filter( $element->totals->valueexcl, FILTER_VALIDATE_FLOAT ) );
				$totals->set_value_inc( Security::filter( $element->totals->valueinc, FILTER_VALIDATE_FLOAT ));
			}

			// Response.
			$result = Security::filter( $element['result'] );

			$response = new SalesInvoiceResponse( $sales_invoice, $result, $element );

			return $response;
		}
	}
}
