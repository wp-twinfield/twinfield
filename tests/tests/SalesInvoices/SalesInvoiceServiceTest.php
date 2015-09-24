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
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Sales invoices service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceServiceTest extends \PHPUnit_Framework_TestCase {
	private $mock = true;

	private $xml_processor;

	private $service;

	/**
	 * Setup the test.
	 */
	public function setUp() {
		parent::setUp();

		$this->mock = false;

		if ( $this->mock ) {
			$this->xml_processor = $this->getMockBuilder( 'Pronamic\WP\Twinfield\XMLProcessor' )
				->disableOriginalConstructor()
				->getMock();
		} else {
			global $credentials;

			$client = new Client();

			$logon_response = $client->logon( $credentials );

			$session = $client->get_session( $logon_response );

			$this->xml_processor = new XMLProcessor( $session );
		}

		$this->service = new SalesInvoiceService( $this->xml_processor );
	}

	/**
	 * Test get sales invoice.
	 *
	 * @dataProvider get_sales_invoice_provider
	 */
	public function test_get_sales_invoice( $office, $type, $invoice_number, $expected_return, $expected_result ) {
		// Mock
		if ( $this->mock ) {
			$file = __DIR__ . '/../../xml/SalesInvoices/' . sprintf(
				'read-sales-invoice-office-%s-type-%s-number-%s.xml',
				$office,
				$type,
				$invoice_number
			);

			if ( is_readable( $file ) ) {
				$this->xml_processor->method( 'process_xml_string' )->willReturn( file_get_contents( $file ) );
			}
		}

		// Service
		$response = $this->service->get_sales_invoice( $office, $type, $invoice_number );

		if ( false === $expected_return ) {
			$this->assertNull( $response );
		} else {
			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoiceResponse', $response );
			$this->assertEquals( $expected_result, $response->get_result() );

			$sales_invoice = $response->get_sales_invoice();

			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoice', $sales_invoice );
		}
	}

	public function get_sales_invoice_provider() {
		if ( $this->mock ) {
			return array(
				// Valid data.
				array(
					'office'         => '11024',
					'type'           => 'FACTUUR',
					'invoice_number' => '1',
					'return'         => true,
					'result'         => Result::SUCCESSFUL,
				),
				// Not existing invoice number.
				array(
					'office'         => '11024',
					'type'           => 'FACTUUR',
					'invoice_number' => '1234567890',
					'return'         => true,
					'result'         => Result::NOT_SUCCESSFUL,
				),
				// Invalid invoice number.
				array(
					'office'         => '11024',
					'type'           => 'FACTUUR',
					'invoice_number' => 'no',
					'return'         => false,
					'result'         => Result::NOT_SUCCESSFUL,
				),
				// Not existing type.
				array(
					'office'         => '11024',
					'type'           => 'no',
					'invoice_number' => '1',
					'return'         => true,
					'result'         => Result::NOT_SUCCESSFUL,
				),
				// Not existing office.
				array(
					'office'         => 'no',
					'type'           => 'FACTUUR',
					'invoice_number' => '1',
					'return'         => true,
					'result'         => Result::NOT_SUCCESSFUL,
				),
			);
		} else {
			return array(
				array(
					'office'         => getenv( 'TWINFIELD_OFFICE_CODE' ),
					'type'           => getenv( 'TWINFIELD_SALES_INVOICE_TYPE' ),
					'invoice_number' => getenv( 'TWINFIELD_SALES_INVOICE_NUMBER' ),
					'return'         => true,
				),
			);
		}
	}

	/**
	 * Test insert sales invoice.
	 *
	 * @dataProvider insert_sales_invoice_provider
	 */
	public function test_insert_sales_invoice( $type, $customer, $article ) {
		$sales_invoice = new SalesInvoice();

		$header = $sales_invoice->get_header();
		$header->set_type( $type );
		$header->set_customer( $customer );

		$line = $sales_invoice->new_line();
		$line->set_article( $article );

		$result = $this->service->insert_sales_invoice( $sales_invoice );
		//$result = false;

		$this->assertInternalType( 'bool', $result );
	}

	public function insert_sales_invoice_provider() {
		return array(
			array(
				'type'     => getenv( 'TWINFIELD_SALES_INVOICE_TYPE' ),
				'customer' => getenv( 'TWINFIELD_CUSTOMER_CODE' ),
				'article'  => getenv( 'TWINFIELD_ARTICLE_CODE' ),
			),
			array(
				'type'     => 'FACTUUR',
				'customer' => '1000',
				'article'  => '001',
			),
		);
	}
}
