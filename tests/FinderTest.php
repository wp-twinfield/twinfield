<?php
/**
 * Finder test
 *
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

/**
 * Finder test
 *
 * This class will test the Twinfield finder features.
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class Pronamic_Twinfield_FinderTest extends PHPUnit_Framework_TestCase {
	/**
	 * Test search
	 */
	public function test_search() {
		global $credentials;

		$client = new Pronamic\WP\Twinfield\Client();

		$logon_response = $client->logon( $credentials );

		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\LogonResponse', $logon_response );
		$this->assertInternalType( 'string', $logon_response->get_cluster() );

		$session = $client->get_session( $logon_response );

		$finder = $client->get_finder( $session );

		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\Finder', $finder );

		$search = new Pronamic\WP\Twinfield\Search( Pronamic\WP\Twinfield\FinderTypes::ART, '*', Pronamic\WP\Twinfield\SearchFields::CODE_AND_NAME, 1, 100 );
		$response = $finder->search( $search );

		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\SearchResponse', $response );

		$data = $response->get_data();

		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\FinderData', $data );

		$columns = $data->get_columns();

		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\ArrayOfString', $columns );

		$items = $data->get_items();

		$this->assertInstanceOf( 'Pronamic\WP\Twinfield\ArrayOfArrayOfString', $items );
	}
}
