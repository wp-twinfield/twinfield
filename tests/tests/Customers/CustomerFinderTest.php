<?php
/**
 * Customer finder test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Customers
 */

namespace Pronamic\WP\Twinfield\Customers;

use PHPUnit\Framework\TestCase;

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
class CustomerFinderTest extends TestCase {
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
	 *
	 * @dataProvider test_provider
	 */
	public function test_get_customers( $search ) {
		$customers = $this->finder->get_customers(
			$search,
			SearchFields::CODE_AND_NAME,
			1,
			100
		);

		$this->assertInternalType( 'array', $customers );
	}

	/**
	 * Data provider for the get customer test function.
	 *
	 * @return array
	 */
	public function test_provider() {
		return array(
			array(
				'search' => 'Pronamic',
			),
			array(
				'search' => 'Remco',
			),
			array(
				'search' => 'Test',
			),
		);
	}
}
