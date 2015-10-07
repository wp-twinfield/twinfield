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
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoice;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceHeader;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceLine;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceResponse;

/**
 * Sales invoices unserializer
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceUnserializer extends Unserializer {
	/**
	 * Unserialize the specified XML to an article.
	 *
	 * @param \SimpleXMLElement $element The XML element to unserialize.
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'salesinvoice' === $element->getName() ) {
			$sales_invoice = new SalesInvoice();

			$header = $sales_invoice->get_header();

			if ( $element->header ) {
				$header->set_office( Security::filter( $element->header->office ) );
				$header->set_type( Security::filter( $element->header->invoicetype ) );
				$header->set_number( Security::filter( $element->header->invoicenumber ) );
				$header->set_date( \DateTime::createFromFormat( 'Ymd', Security::filter( $element->header->invoicedate ) ) );
				$header->set_due_date( \DateTime::createFromFormat( 'Ymd', Security::filter( $element->header->invoicedate ) ) );
				$header->set_bank( Security::filter( $element->header->bank ) );
				$header->set_customer( Security::filter( $element->header->customer ) );
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
				}
			}

			// Response.
			$result = Security::filter( $element['result'] );

			$response = new SalesInvoiceResponse( $sales_invoice, $result, $element );

			return $response;
		}
	}
}
