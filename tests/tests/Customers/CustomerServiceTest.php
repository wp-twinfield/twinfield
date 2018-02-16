<?php
/**
 * Customer service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 */

namespace Pronamic\WP\Twinfield\Customers;

use PHPUnit\Framework\TestCase;

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
class CustomerServiceTest extends TestCase {
	/**
	 * Flag for mock requests to Twinfield.
	 *
	 * @var boolean
	 */
	private $mock = true;

	/**
	 * The XML processor to use in this test.
	 *
	 * @var Pronamic\WP\Twinfield\XMLProcessor
	 */
	private $xml_processor;

	/**
	 * The service to use in this test.
	 *
	 * @var CustomerService
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

		$this->service = new CustomerService( $this->xml_processor );
	}

	/**
	 * Test get customer.
	 *
	 * @param boolean $mock   Flag to mock Twinfield response.
	 * @param string  $office The office to retrive the customer from.
	 * @param string  $code   The code of the customer to retrieve.
	 * @param mixed   $return The expected Twinfield return.
	 * @dataProvider get_customer_provider
	 */
	public function test_get_customer( $mock, $office, $code, $return ) {
		// Mock.
		if ( $mock ) {
			$response = file_get_contents( __DIR__ . '/../../xml/Customers/' . $mock );

			$this->xml_processor->method( 'process_xml_string' )->willReturn( $response );
		}

		// Service.
		$response = $this->service->get_customer( $office, $code );

		if ( false === $return ) {
			$this->assertNull( $response );
		} else {
			$this->assertInstanceOf( __NAMESPACE__ . '\CustomerResponse', $response );
			$this->assertEquals( Result::SUCCESSFUL, $response->get_result() );
			$this->assertTrue( $response->is_successful() );
			$this->assertFalse( $response->is_not_successful() );

			$customer = $response->get_customer();

			$this->assertInstanceOf( __NAMESPACE__ . '\Customer', $customer );
		}
	}

	/**
	 * Data provider for the get customer test function.
	 *
	 * @return array
	 */
	public function get_customer_provider() {
		$no_mock = filter_var( getenv( 'TWINFIELD_TESTS_NO_MOCK' ), FILTER_VALIDATE_BOOLEAN );

		if ( $no_mock ) {
			return array(
				array(
					'mock'   => false,
					'office' => getenv( 'TWINFIELD_OFFICE_CODE' ),
					'code'   => getenv( 'TWINFIELD_CUSTOMER_CODE' ),
					'return' => true,
				),
			);
		} else {
			return array(
				array( // Valid respone.
					'mock'   => 'read-dimensions-deb-response-1.xml',
					'office' => '123456',
					'code'   => '1002',
					'return' => true,
				),
				array( // Valid respone.
					'mock'   => 'read-dimensions-deb-response-2.xml',
					'office' => '12345',
					'code'   => '12345',
					'return' => true,
				),
				array( // Empty response.
					'mock'   => 'read-dimensions-deb-response-empty.xml',
					'office' => null,
					'code'   => null,
					'return' => false,
				),
			);
		}
	}

	/**
	 * Test insert customer.
	 *
	 * @param boolean $mock   Flag to mock or not.
	 * @param string  $office Office code.
	 * @param string  $name   Office name.
	 * @dataProvider insert_customer_provider
	 */
	public function test_insert_customer( $mock, $office, $name ) {
		if ( $mock ) {
			$file = __DIR__ . '/../../xml/Customers/' . $mock;

			if ( is_readable( $file ) ) {
				$this->xml_processor->method( 'process_xml_string' )->willReturn( file_get_contents( $file ) );
			}
		}

		$customer = new Customer();
		$customer->set_office( $office );
		$customer->set_name( $name );

		$result = $this->service->insert_customer( $customer );
	}

	/**
	 * Test data provider for the insert customer test.
	 *
	 * @return array An array with test data.
	 */
	public function insert_customer_provider() {
		$no_mock = filter_var( getenv( 'TWINFIELD_TESTS_NO_MOCK' ), FILTER_VALIDATE_BOOLEAN );

		if ( $no_mock ) {
			return array(
				array(
					'mock'   => false,
					'office' => getenv( 'TWINFIELD_OFFICE_CODE' ),
					'name'   => 'Test',
				),
			);
		} else {
			return array(
				array( // Result.
					'mock'   => 'insert-dimension-result-1.xml',
					'office' => '11024',
					'name'   => 'Test',
				),
				array( // No office.
					'mock'   => 'insert-dimension-office-no.xml',
					'office' => null,
					'name'   => 'Test',
				),
			);
		}
	}
}
