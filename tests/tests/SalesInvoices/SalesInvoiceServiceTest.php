<?php
/**
 * Sales invoices service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\SalesInvoices;

use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Sales invoices service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class SalesInvoiceServiceTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Flag for mock requests to Twinfield.
	 *
	 * @var boolean
	 */
	private $mock = true;

	/**
	 * The XML processor object.
	 *
	 * @var XMLProcessor
	 */
	private $xml_processor;

	/**
	 * The sales invoice service object.
	 *
	 * @var SalesInvoiceService
	 */
	private $service;

	/**
	 * Setup the test.
	 */
	public function setUp() {
		parent::setUp();

		$this->mock = ! filter_var( getenv( 'TWINFIELD_TESTS_NO_MOCK' ), FILTER_VALIDATE_BOOLEAN );

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
	 * @param string $office The office code to get the sales invoice from.
	 * @param string $type The type of invoice to get.
	 * @param string $invoice_number The number of the invoice to get.
	 * @param mixed  $expected_return An indicator of what the expected return value should be.
	 * @param mixed  $expected_result An indicator of what the expected return result should be.
	 * @dataProvider get_sales_invoice_provider
	 */
	public function test_get_sales_invoice( $office, $type, $invoice_number, $expected_return, $expected_result ) {
		// Mock.
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

		// Test.
		$response = $this->service->get_sales_invoice( $office, $type, $invoice_number );

		if ( false === $expected_return ) {
			$this->assertNull( $response );
		} else {
			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoiceResponse', $response );
			$this->assertEquals( $expected_result, $response->get_result() );

			$sales_invoice = $response->get_sales_invoice();

			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoice', $sales_invoice );

			$header = $sales_invoice->get_header();

			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoiceHeader', $header );

			if ( $response->is_successful() ) {
				$this->assertEquals( $office, $header->get_office() );
				$this->assertEquals( $type, $header->get_type() );
				$this->assertEquals( $invoice_number, $header->get_number() );
			}
		}
	}

	/**
	 * Test data provider for the get sales invoice test.
	 *
	 * @return array An array with test data.
	 */
	public function get_sales_invoice_provider() {
		$no_mock = filter_var( getenv( 'TWINFIELD_TESTS_NO_MOCK' ), FILTER_VALIDATE_BOOLEAN );

		if ( $no_mock ) {
			return array(
				array(
					'office'         => getenv( 'TWINFIELD_OFFICE_CODE' ),
					'type'           => getenv( 'TWINFIELD_SALES_INVOICE_TYPE' ),
					'invoice_number' => getenv( 'TWINFIELD_SALES_INVOICE_NUMBER' ),
					'return'         => true,
				),
			);
		} else {
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
		}
	}

	/**
	 * Test insert sales invoice.
	 *
	 * @param boolean $mock An flag to indicate the Twinfield response should be mocked.
	 * @param string  $type The type of invoice to insert.
	 * @param string  $customer The customer of invoice to insert.
	 * @param string  $office The office code of invoice to insert.
	 * @param string  $article The article of invoice to inssert.
	 * @param string  $subarticle The subarticle of invoice to inssert.
	 * @param mixed   $expected_return An indicator of what the expected return value should be.
	 * @param mixed   $expected_result An indicator of what the expected return result should be.
	 * @dataProvider insert_sales_invoice_provider
	 */
	public function test_insert_sales_invoice( $mock, $type, $customer, $office, $article, $subarticle, $expected_return, $expected_result ) {
		// Mock.
		if ( $mock ) {
			$file = __DIR__ . '/../../xml/SalesInvoices/' . $mock;

			if ( is_readable( $file ) ) {
				$this->xml_processor->method( 'process_xml_string' )->willReturn( file_get_contents( $file ) );
			}
		}

		// Test.
		$sales_invoice = new SalesInvoice();

		$header = $sales_invoice->get_header();
		$header->set_type( $type );
		$header->set_customer( $customer );

		$line = $sales_invoice->new_line();
		$line->set_article( $article );
		$line->set_subarticle( $subarticle );

		$response = $this->service->insert_sales_invoice( $sales_invoice );

		if ( false === $expected_return ) {
			$this->assertNull( $response );
		} else {
			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoiceResponse', $response );
			$this->assertEquals( $expected_result, $response->get_result() );

			$sales_invoice = $response->get_sales_invoice();

			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoice', $sales_invoice );

			$header = $sales_invoice->get_header();

			$this->assertInstanceOf( __NAMESPACE__ . '\SalesInvoiceHeader', $header );

			if ( $response->is_successful() ) {
				$this->assertEquals( $office, $header->get_office() );
				$this->assertEquals( $type, $header->get_type() );
				$this->assertNotEmpty( $header->get_number() );
			}
		}
	}

	/**
	 * Test data provider for the insert sales invoice test.
	 *
	 * @return array An array with test data.
	 */
	public function insert_sales_invoice_provider() {
		$no_mock = filter_var( getenv( 'TWINFIELD_TESTS_NO_MOCK' ), FILTER_VALIDATE_BOOLEAN );

		if ( $no_mock ) {
			return array(
				array(
					'mock'       => false,
					'type'       => getenv( 'TWINFIELD_SALES_INVOICE_TYPE' ),
					'customer'   => getenv( 'TWINFIELD_CUSTOMER_CODE' ),
					'office'     => getenv( 'TWINFIELD_OFFICE_CODE' ),
					'article'    => getenv( 'TWINFIELD_ARTICLE_CODE' ),
					'subarticle' => getenv( 'TWINFIELD_SUBARTICLE_CODE' ),
					'return'     => true,
					'result'     => Result::SUCCESSFUL,
				),
			);
		} else {
			return array(
				// Valid item, subarticle can be empty for this article.
				array(
					'mock'       => 'insert-sales-invoice-result-1.xml',
					'type'       => 'FACTUUR',
					'customer'   => '1000',
					'office'     => '11024',
					'article'    => '001',
					'subarticle' => '',
					'return'     => true,
					'result'     => Result::SUCCESSFUL,
				),
				// Sales invoice type is empty.
				array(
					'mock'       => 'insert-sales-invoice-type-empty.xml',
					'type'       => '',
					'customer'   => '1000',
					'office'     => '11024',
					'article'    => '001',
					'subarticle' => '',
					'return'     => true,
					'result'     => Result::NOT_SUCCESSFUL,
				),
				// The subcode of the article can not be empty.
				array(
					'mock'       => 'insert-sales-invoice-subarticle-empty.xml',
					'type'       => 'FACTUUR',
					'customer'   => '1000',
					'office'     => '11024',
					'article'    => 'SUCURI',
					'subarticle' => '',
					'return'     => true,
					'result'     => Result::NOT_SUCCESSFUL,
				),
			);
		}
	}
}
