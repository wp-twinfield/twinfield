<?php
/**
 * Finder test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield;

use PHPUnit\Framework\TestCase;
use Pronamic\WP\Twinfield\Authentication\WebServicesAuthenticationStrategy;

/**
 * Finder test
 *
 * This class will test the Twinfield finder features.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class FinderTest extends TestCase {
	/**
	 * Test search
	 */
	public function test_search() {
		global $credentials;

		$authentication_strategy = new WebServicesAuthenticationStrategy( $credentials );

		$client = new Client( $authentication_strategy );

		$client->login();

		$finder = $client->get_finder();

		$this->assertInstanceOf( __NAMESPACE__ . '\Finder', $finder );

		$search = new Search( FinderTypes::ART, '*', SearchFields::CODE_AND_NAME, 1, 100 );

		$response = $finder->search( $search );
		$this->assertInstanceOf( __NAMESPACE__ . '\SearchResponse', $response );

		$result = $response->get_search_result();
		$this->assertInstanceOf( __NAMESPACE__ . '\ArrayOfMessageOfErrorCodes', $result );

		$data = $response->get_data();
		$this->assertInstanceOf( __NAMESPACE__ . '\FinderData', $data );

		$total_rows = $data->get_total_rows();
		$this->assertInternalType( 'int', $total_rows );

		$columns = $data->get_columns();
		$this->assertInstanceOf( __NAMESPACE__ . '\ArrayOfString', $columns );

		$items = $data->get_items();
		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\ArrayOfArrayOfString', $items );
	}
}
