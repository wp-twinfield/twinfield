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
use Pronamic\WP\Twinfield\XMLProcessor;

/**
 * Sales invoices service test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/SalesInvoice
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerServiceTest extends \PHPUnit_Framework_TestCase {
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

		$this->service = new CustomerService( $xml_processor );
	}

	/**
	 * Test get customer.
	 */
	public function test_get_customer() {
		$office = getenv( 'TWINFIELD_OFFICE_CODE' );
		$code   = getenv( 'TWINFIELD_CUSTOMER_CODE' );

		$customer = $this->service->get_customer( $office, $code );

		$this->assertInstanceOf( __NAMESPACE__ . '\Customer', $customer );
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
