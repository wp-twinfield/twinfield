<?php
/**
 * Customer finder test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Customers
 */

namespace Pronamic\WP\Twinfield\Customers;

use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\Finder;
use Pronamic\WP\Twinfield\SearchFields;

/**
 * Customer finder test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/Customers
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class CustomerFinderTest extends \PHPUnit_Framework_TestCase {
	/**
	 * The customer finder.
	 *
	 * @var CustomerFinder
	 */
	private $finder;

	/**
	 * Setup the test.
	 */
	public function setUp() {
		parent::setUp();

		global $credentials;

		$client = new Client();

		$logon_response = $client->logon( $credentials );

		$session = $client->get_session( $logon_response );

		$this->finder = new CustomerFinder( new Finder( $session ) );
	}

	/**
	 * Test get customers.
	 */
	public function test_get_customers() {
		$customers = $this->finder->get_customers(
			'Pronamic',
			SearchFields::CODE_AND_NAME,
			1,
			100
		);

		$this->assertInternalType( 'array', $customers );
	}
}
