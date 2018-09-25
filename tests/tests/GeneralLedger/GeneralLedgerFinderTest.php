<?php
/**
 * General Ledger finder test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield/GeneralLedger
 */

namespace Pronamic\WP\Twinfield\GeneralLedger;

use PHPUnit\Framework\TestCase;

use Pronamic\WP\Twinfield\Client;
use Pronamic\WP\Twinfield\Result;
use Pronamic\WP\Twinfield\Finder;
use Pronamic\WP\Twinfield\SearchFields;
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

/**
 * General Ledger finder test
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield/GeneralLedger
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class GeneralLedgerFinderTest extends TestCase {
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

		$this->finder = new GeneralLedgerFinder( $client->get_finder() );
	}

	/**
	 * Test get general ledger.
	 *
	 * @param string $search The search pattern. May contain wildcards * and ?.
	 * @dataProvider provider
	 */
	public function test_get_general_ledger( $search ) {
		$general_ledger = $this->finder->get_transactions(
			$search,
			SearchFields::CODE_AND_NAME,
			1,
			100
		);

		$this->assertInternalType( 'array', $general_ledger );
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
