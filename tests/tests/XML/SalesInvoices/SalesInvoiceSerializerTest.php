<?php
/**
 * Sales invoices XML serializer test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\SalesInvoices;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoice;
use Pronamic\WP\Twinfield\SalesInvoices\SalesInvoiceHeader;

/**
 * Sales invoices XML serializer test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceSerializerTest extends TestCase {
	/**
	 * Test
	 */
	public function test() {
		$sales_invoice = new SalesInvoice();

		$header = $sales_invoice->get_header();
		$header->set_type( getenv( 'TWINFIELD_SALES_INVOICE_TYPE' ) );
		$header->set_customer( getenv( 'TWINFIELD_CUSTOMER_CODE' ) );

		$serializer = new SalesInvoiceSerializer( $sales_invoice );

		$string = (string) $serializer;

		$this->assertInternalType( 'string', $string );
	}
}
