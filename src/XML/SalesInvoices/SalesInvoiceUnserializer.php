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
	 */
	public function unserialize( \SimpleXMLElement $element ) {
		if ( 'salesinvoice' === $element->getName() && '0' !== (string) $element['result'] ) {
			$header = new SalesInvoiceHeader();

			if ( $element->header ) {
				$header->set_office( Security::filter( $element->header->office ) );
				$header->set_type( Security::filter( $element->header->invoicetype ) );
				$header->set_number( Security::filter( $element->header->invoicenumber ) );
				$header->set_date( new \DateTime( Security::filter( $element->header->invoicedate ) ) );
			}

			$lines  = array();

			foreach ( $element->lines->line as $element_line ) {
				$line = new SalesInvoiceLine();

				$line->set_id( Security::filter( $element_line['id'] ) );
				$line->set_description( Security::filter( $element_line->description ) );

				$lines[] = $line;
			}

			$sales_invoice = new SalesInvoice( $header, $lines );

			var_dump( $sales_invoice );
		}
	}
}
