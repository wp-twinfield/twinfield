<?php
/**
 * Office service test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 */

namespace Pronamic\WP\Twinfield\Offices;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Office service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class OfficeServiceTest extends TestCase {
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

		$this->service = new OfficeService( $this->xml_processor );
	}

	/**
	 * Test list offices
	 */
	public function test_get_offices() {
		// Mock.
		if ( $this->mock ) {
			$response = file_get_contents( __DIR__ . '/../../xml/Offices/list-offices.xml' );

			$this->xml_processor->method( 'process_xml_string' )->willReturn( $response );
		}

		// Service.
		$offices = $this->service->get_offices();

		$this->assertInternalType( 'array', $offices );
	}
}
