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
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

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

		$authentication_strategy = new WebServicesAuthenticationStrategy( $credentials );

		$client = new Client( $authentication_strategy );

		$client->login();

		$this->finder = new CustomerFinder( $client->get_finder() );
	}

	/**
	 * Test get customers.
	 *
	 * @param string $search The search pattern. May contain wildcards * and ?.
	 * @dataProvider provider
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
	public function provider() {
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
