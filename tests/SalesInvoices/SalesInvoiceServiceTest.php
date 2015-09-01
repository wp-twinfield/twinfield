<?php
/**
 * Sales invoices service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Sales invoices service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceServiceTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test
	 */
	public function test() {
		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );

		$session = $client->get_session( $logon_response );

		$xml_processor = new XMLProcessor( $session );

		$service = new SalesInvoiceService( $xml_processor );

		$office         = getenv( 'TWINFIELD_OFFICE_CODE' );
		$type           = getenv( 'TWINFIELD_SALES_INVOICE_TYPE' );
		$invoice_number = getenv( 'TWINFIELD_SALES_INVOICE_NUMBER' );

		$sales_invoice = $service->get_sales_invoice( $office, $type, $invoice_number );


	}
}
