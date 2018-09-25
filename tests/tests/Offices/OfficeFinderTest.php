<?php
/**
 * Office finder test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/Customers
 */

namespace Pronamic\WP\Twinfield\Offices;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\Finder;
use Pronamic\WP\Twinfield\SearchFields;
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

/**
 * Office finder test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/Customers
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class OfficeFinderTest extends TestCase {
	/**
	 * The office finder.
	 *
	 * @var OfficeFinder
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

		$this->finder = new OfficeFinder( $client->get_finder() );
	}

	/**
	 * Test get offices.
	 *
	 * @dataProvider provider
	 * @param string $search The search pattern. May contain wildcards * and ?.
	 */
	public function test_get_offices( $search ) {
		$offices = $this->finder->get_offices(
			$search,
			SearchFields::CODE_AND_NAME,
			0,
			100
		);

		$this->assertInternalType( 'array', $offices );
	}

	/**
	 * Data provider for the get customer test function.
	 *
	 * @return array
	 */
	public function provider() {
		return array(
			array(
				'search' => '*',
			),
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
