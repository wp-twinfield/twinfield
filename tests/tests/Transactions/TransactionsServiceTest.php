<?php
/**
 * Transactions service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 */

namespace Pronamic\WP\Twinfield\Transactions;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Transactions service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoices
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class TransactionsServiceTest extends TestCase {
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

		$this->service = new TransactionsService( $this->xml_processor );
	}

	/**
	 * Test get sales invoice.
	 *
	 * @param string $office The office code to get the sales invoice from.
	 * @param string $code The code of transaction to get.
	 * @param string $number The number of the transaction to get.
	 * @param mixed  $expected_return An indicator of what the expected return value should be.
	 * @param mixed  $expected_result An indicator of what the expected return result should be.
	 * @dataProvider get_transaction_provider
	 */
	public function test_get_transaction( $office, $code, $number, $expected_return, $expected_result ) {
		// Mock.
		if ( $this->mock ) {
			$file = __DIR__ . '/../../xml/Transactions/' . sprintf(
				'read-response-transaction-office-%s-code-%s-number-%s.xml',
				$office,
				$code,
				$number
			);

			if ( is_readable( $file ) ) {
				$this->xml_processor->method( 'process_xml_string' )->willReturn( file_get_contents( $file ) );
			}
		}

		// Test.
		$response = $this->service->get_transaction( $office, $code, $number );

		if ( false === $expected_return ) {
			$this->assertNull( $response );
		} else {
			$this->assertInstanceOf( __NAMESPACE__ . '\TransactionResponse', $response );
			$this->assertEquals( $expected_result, $response->get_result() );

			$transaction = $response->get_transaction();

			$this->assertInstanceOf( __NAMESPACE__ . '\Transaction', $transaction );

			$header = $transaction->get_header();

			$this->assertInstanceOf( __NAMESPACE__ . '\TransactionHeader', $header );

			if ( $response->is_successful() ) {
				$this->assertEquals( $office, $header->get_office() );
				$this->assertEquals( $code, $header->get_code() );
				$this->assertEquals( $number, $header->get_number() );
			}
		}
	}

	/**
	 * Test data provider for the get transaction test.
	 *
	 * @return array An array with test data.
	 */
	public function get_transaction_provider() {
		$no_mock = filter_var( getenv( 'TWINFIELD_TESTS_NO_MOCK' ), FILTER_VALIDATE_BOOLEAN );

		if ( $no_mock ) {
			return array(
				array(
					'office' => getenv( 'TWINFIELD_OFFICE_CODE' ),
					'code'   => 'INK',
					'number' => '201400001',
					'return' => true,
					'result' => Result::SUCCESSFUL,
				),
			);
		} else {
			return array(
				// Valid data.
				array(
					'office' => '11024',
					'code'   => 'INK',
					'number' => '201400001',
					'return' => true,
					'result' => Result::SUCCESSFUL,
				),
			);
		}
	}
}
