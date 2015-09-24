<?php
/**
 * Customer service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 */

namespace Pronamic\WP\Twinfield\Customers;

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
class CustomerServiceTest extends \PHPUnit_Framework_TestCase {
	private $xml_processor;

	private $service;

	/**
	 * Setup the test.
	 */
	public function setUp() {
		parent::setUp();

		/*
		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );

		$session = $client->get_session( $logon_response );

		$xml_processor = new XMLProcessor( $session );
		*/

		$this->xml_processor = $this->getMockBuilder( 'Pronamic\WP\Twinfield\XMLProcessor' )
			->disableOriginalConstructor()
			->getMock();

		$this->service = new CustomerService( $this->xml_processor );
	}

	/**
	 * Test get customer.
	 *
	 * @dataProvider get_customer_provider
	 */
	public function test_get_customer( $office, $code, $file, $return ) {
		// Mock
		$response = file_get_contents( __DIR__ . '/../../xml/Customers/' . $file );

		$this->xml_processor->method( 'process_xml_string' )->willReturn( $response );

		// Service
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

	public function get_customer_provider() {
		return array(
			array(
				'office' => getenv( 'TWINFIELD_OFFICE_CODE' ),
				'code'   => getenv( 'TWINFIELD_CUSTOMER_CODE' ),
				'file'   => 'read-dimensions-deb-response-1.xml',
				'return' => true,
			),
			array(
				'office' => getenv( 'TWINFIELD_OFFICE_CODE' ),
				'code'   => getenv( 'TWINFIELD_CUSTOMER_CODE' ),
				'file'   => 'read-dimensions-deb-response-2.xml',
				'return' => true,
			),
			array(
				'office' => getenv( 'TWINFIELD_OFFICE_CODE' ),
				'code'   => getenv( 'TWINFIELD_CUSTOMER_CODE' ),
				'file'   => 'read-dimensions-deb-response-empty.xml',
				'return' => false,
			),
		);
	}

	/**
	 * Test insert customer.
	 */
	public function test_insert_customer() {
		$customer = new Customer();

		// $result = $this->service->insert_customer( $customer );

		// $this->assertInternalType( 'bool', $result );
	}
}
