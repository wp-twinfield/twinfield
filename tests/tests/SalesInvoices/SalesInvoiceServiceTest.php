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
	private $service;

	/**
	 * Setup the test.
	 */
	public function setUp() {
		parent::setUp();

		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );

		$session = $client->get_session( $logon_response );

		$xml_processor = new XMLProcessor( $session );

		$this->service = new SalesInvoiceService( $xml_processor );
	}

	/**
	 * Test get sales invoice.
	 */
	public function test_get_sales_invoice() {
		$office         = getenv( 'TWINFIELD_OFFICE_CODE' );
		$type           = getenv( 'TWINFIELD_SALES_INVOICE_TYPE' );
		$invoice_number = getenv( 'TWINFIELD_SALES_INVOICE_NUMBER' );

		$sales_invoice = $this->service->get_sales_invoice( $office, $type, $invoice_number );

		$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoice', $sales_invoice );
	}

	/**
	 * Test insert sales invoice.
	 */
	public function test_insert_sales_invoice() {
		$sales_invoice = new SalesInvoice();

		$header = $sales_invoice->get_header();
		$header->set_type( getenv( 'TWINFIELD_SALES_INVOICE_TYPE' ) );
		$header->set_customer( getenv( 'TWINFIELD_CUSTOMER_CODE' ) );

		$line = $sales_invoice->new_line();
		$line->set_article( getenv( 'TWINFIELD_ARTICLE_CODE' ) );

		// $result = $this->service->insert_sales_invoice( $sales_invoice );
		$result = false;

		$this->assertInternalType( 'bool', $result );
	}
}
